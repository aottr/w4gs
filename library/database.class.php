<?php

/**
 * Class Database
 * Easy and more secure way to create a database connection
 * Supports select, insert, update and delete Data manipulation
 * @author staubrein <me@staubrein.com>
 */
class Database extends PDO {

    /**
     * Creates a Database connection
     * @param string $dbtype Type of the Database
     * @param string $dbhost Database Hostname/IP-Address
     * @param string $dbname Name of the Database
     * @param string $dbuser Name of the Database-User
     * @param string $pass Password of the Database-User
     */
    public function __construct($dbtype, $dbhost, $dbname, $dbuser, $pass) {
        
        try {
            parent::__construct($dbtype . ':host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $pass);
        } catch(Exception $ex) {
            exit(155);
        }
        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    /**
     * select data from a SQL Database using PDO
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
     * insert data into a SQL Database Table
     * @param string $table A name of table to insert into
     * @param array $data An associative array
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
     * update data in a given table, specified by the arguments
     * @param string $table A name of table to update
     * @param array $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        
        ksort($data);

        $fieldDetails = null;

        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key, ";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE " . DB_PREF . "$table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }
    
    /**
     * delete a table row
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return array Affected rows
     */
    public function delete($table, $where, $limit = 1) {
        
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}
