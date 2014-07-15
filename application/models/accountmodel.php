<?php

class AccountModel extends Model
{
		function __construct()
	{
		parent::__construct();
	}

	function login()
	{
		$sth = $this->db->prepare("SELECT id, roleid FROM " . DB_PREF . "user WHERE 
			name = :username && password = :password");
		$sth->execute(array(
			':username' => $_POST['username'],
			':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY),
		));

		$data = $sth->fetch();

		// if rowCount equals 1
		if($sth->rowCount())
		{
			Session::set('loggedin', "true");
			Session::set('userid', $data['id']);
			return true;
		}
		else
			return false;
	}
    
    function register()
    {
        
    }
    
    function dashboard($id)
    {
        $sth = $this->db->prepare("SELECT roleid, name FROM " . DB_PREF . "user WHERE id = :id");
		$sth->execute(array(
			':id' => $id
		));    
        $data = $sth->fetch();
        $this->name = $data['name'];
        
        $sth = $this->db->prepare("SELECT DISTINCT event.name, event.id FROM event, payment WHERE event.id = payment.eventid AND payment.userid = :id");
		$sth->execute(array(
			':id' => $id
		));    
        $this->events = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}