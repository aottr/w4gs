<?php
/**
 * Description of auth
 *
 * @author staubrein <me@staubrein.com>
 */
class Auth {
    
    public static function handleLogin() {
                
        Session::init();
        if(Session::get('loggedIn')) {
            
            session_destroy();
            header('Location: ' . BASE_URL . 'login');
            exit;
	}
    }
}

?>
