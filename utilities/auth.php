<?php

/**
 * Description of auth
 *
 * @author staubrein <me@staubrein.com>
 */
class Auth {
    
    public static function handleLogin() {
                
        Session::init();

		//Session::set("uid", 1);
		
        if(!Session::get("uid")) {
            
            Session::destroy();
            header('Location: ' . BASE_URL . 'user/login');
            exit(30); // not logged in
		}
    }
    
    public static function handlePermission($level) {
                
        Session::init();

		//Session::set("uid", 1);
		
        if(!Session::get("plvl")) {
            
            Session::destroy();
            header('Location: ' . BASE_URL . 'user/login');
            exit;
		
		} else if(Session::get("plvl") > $level) {
			
			header('Location: ' . BASE_URL . 'user/login');
            exit(31); // Insufficient user rights
		}
    }
}
