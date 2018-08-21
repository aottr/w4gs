<?php

/**
 * Description of val
 *
 * @author staubrein <me@staubrein.com>
 */
class Validate {

    public function __construct() {
        ;
    }

    public function minlength($data, $arg, $name = "") {

        if(strlen($data) < $arg) {

            if(empty($name))
                return "Die Zeichenkette muss mindestens $arg Zeichen lang sein.";
            else
                return $name . " ist zu kurz. Mindestzeichenzahl: $arg";

        }
    }
    public function maxlength($data, $arg, $name = "") {

        if(strlen($data) > $arg) {

            if(empty($name))
                return "Die Zeichenkette darf h&ooum;chstens $arg Zeichen lang sein.";
            else
                return $name . " ist zu lang. Maximal $arg Zeichen.";
        }
    }

    public function digit($data, $name = "") {

        if(!ctype_digit($data)) {
            if(empty($name))
                return "Der eingegebene Wert ist keine Zahl.";
            else
                return $name . " ist keine Zahl.";
        }
    }

    public function __call($name, $arguments) {

        throw new Exception("$name does not exist inside of: " . __CLASS__);
    }
}

?>
