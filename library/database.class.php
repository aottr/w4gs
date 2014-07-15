<?php

class Database extends PDO {

    public function __construct($dbtype, $dbhost, $dbname, $dbuser, $pass) {
        
        try {
            parent::__construct($dbtype . ':host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $pass);
        } catch(Exception $ex) {
            echo "Could not connect to the configured database: '$dbname'.";
        }
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $bindParams Parameters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $bindParams = array(), $fetchMode = PDO::FETCH_ASSOC) {
        
        $sth = $this->prepare($sql);
        foreach ($bindParams as $key => $value) {
            $sth->bindValue($key, $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO " . DB_PREF . "$table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $sth->bindValue($key, $value);
        }
        $sth->execute();
    }

    /**
     * update
     * @param string $table A name of table to update
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        
        ksort($data);

        $fieldDetails = null;

        foreach ($data as $key => $value) {
            $fieldDetails .= '`$key`=:$key, ';
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE " . DB_PREF . "$table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }
    
    /**
     * delete
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return Affected rows
     */
    public function delete($table, $where, $limit = 1) {
        
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}