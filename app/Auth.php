<?php
class Auth
{

    public function __construct()
    {
        session_start();
    }

    public function checkAdmin()
    {
        return $_SESSION["user_status"] == 'admin';
    }

    public function getLogin()
    {
      if(isset($_SESSION["user_login"])) {   
        return $_SESSION["user_login"];
      } else {
        return "Guest";
      }
    }

    public function setUser($login, $status)
    {
        $_SESSION["user_login"] = $login;
        $_SESSION["user_status"] = $status;
    }

    public function checkAuth()
    {
        return isset($_SESSION["user_login"]);
    }
    public function logout()
    {
        unset($_SESSION['session_login']);
        unset($_SESSION['user_status']);
        session_destroy();
        header("Location: /");
        die();
    }

}

