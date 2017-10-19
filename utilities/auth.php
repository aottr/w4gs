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
		
        if(Session::get("uid") == NULL) {
            
            Session::destroy();
            header('Location: ' . BASE_URL . 'user/login');
            exit;
		}
    }
    
    public static function handlePermission($level) {
                
        Session::init();

		//Session::set("uid", 1);
		
        if(Session::get("plvl") == NULL) {
            
            Session::destroy();
            header('Location: ' . BASE_URL . 'user/login');
            exit;
		
		} else if(Session::get("plvl") > $level) {
			
			header('Location: ' . BASE_URL . 'user/login');
            exit;
		}
    }
}
