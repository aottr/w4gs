<?php

/**
 * Description of auth
 *
 * @author staubrein <me@staubrein.com>
 */
class Auth {

    public static function redirectIfLoggedIn() {
        if (self::loginStatus())
            redirect(BASE_URL . 'license');
    }

    public static function redirectIfNotLoggedIn() {
        if(!self::loginStatus())
            redirect(BASE_URL . 'user/login');
    }

    public static function loginStatus() {

        if (Session::get("user_id") && Session::get('username') && Session::get('login_string')) {

            $user_id = Session::get("user_id");
            $username = Session::get('username');
            $login_string = Session::get('login_string');

            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

            $result = $db->select("SELECT password, admin FROM User WHERE id = :user_id AND active = 1 LIMIT 1", array('user_id' => $user_id));

            if(sizeof($result) != 1)
                return FALSE;

            $result = $result[0];

            // falscherweise Admin?
            if($result['admin'] != 1 && Session::get('access') == 'admin')
                return FALSE;

            $password = $result['password'];
            $login_check = hash('sha512', $password . $user_browser);

            if($login_check == $login_string)
                return TRUE;
        }
        return FALSE;
    }

    public static function resellerStatus() {

        if(!self::loginStatus())
            return FALSE;

        $user_id = Session::get("user_id");
        $db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $result = $db->select(
            "SELECT reseller 
             FROM User 
             WHERE id = :user_id",
            array( ':user_id' => $user_id)
        );

        if(sizeof($result) != 1)
            return FALSE;

        if($result[0]['reseller'] == -1)
            return TRUE;

        return FALSE;
    }

    public static function adminStatus() {

        if(!self::loginStatus())
            return FALSE;

        $access = Session::get('access');
        if($access == 'admin')
            return TRUE;

        return FALSE;
    }
}