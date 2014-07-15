<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author Dustin Kröger
 */
class Auth {
    
    public static function handleLogin() {
                
        @session_start();
        if(!isset($_SESSION['loggedIn'])) {
            
            session_destroy();
            header('Location: ' . BASE_URL . 'login');
            exit;
	}
    }
}

?>
