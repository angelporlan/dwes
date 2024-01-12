<?php

class User

{
    public $name = "";
    public $lastname = "";
    public $email = "";
    public $password = "";
    public $img = "";

    public function __construct() {
        $this->img = "default.png";
    }
}

?>