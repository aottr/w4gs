<?php

class EventModel extends Model
{
	function __construct()
	{
		parent::__construct();     
	}
    
    function listall()
    {
        $sth = $this->db->prepare("SELECT * FROM " . DB_PREF . "event");
		$sth->execute(); 
        $this->eventlist = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function load($id)
    {
        $sth = $this->db->prepare("SELECT * FROM " . DB_PREF . "event WHERE 
			id = :id");
		$sth->execute(array(
			':id' => $id
        ));
        
        $data = $sth->fetch();
        
       // $data = $this->db->select("SELECT * FROM " . DB_PREF . "event WHERE id = :id", array(':id' => $id));                   
        
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->approach = $data['approach'];
    }
    
    function orders($id)
    {
        $sth = $this->db->prepare("SELECT * FROM `" . DB_PREF . "order` WHERE 
			`eventid` = :id");
		$sth->execute(array(
			':id' => $id
        ));
        
        $this->orderdata = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function order($id, $userid, $orderid)
    {
        $this->db->insert('payment', array('eventid' => $id, 'userid' => $userid,
            'orderid' => $orderid, 'datetime' => date("Y-m-d H:i:s"))); 
    }
}