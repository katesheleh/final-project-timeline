<?php
class InitSession extends DBTableUsers {
    private $dbTableUser;
    private $isAuth = false;
    private $userName = '';
    private $userId = '';
    private $currentSessionEmail;

    public function __construct() {
        $this -> dbTableUser = new DBTableUsers();
    }

    public function getIsAuth() {
        if (isset($_SESSION['userEmail'])) {
            $this -> isAuth = true;
        }

        return $this -> isAuth;
    }

    public function getUserName() {
        if (isset($_SESSION['userEmail'])) {
            $this -> currentSessionEmail = $_SESSION['userEmail'];
            $this -> userName = $this -> dbTableUser -> getSingleUserByEmail($this -> currentSessionEmail)['name'];
        }

        return $this -> userName;
    }

    public function getUserId() {
        if (isset($_SESSION['userEmail'])) {
            $this -> currentSessionEmail = $_SESSION['userEmail'];
            $this -> userId = $this -> dbTableUser -> getSingleUserByEmail($this -> currentSessionEmail)['id'];
        }

        return $this -> userId;
    }

    public function destroy() {
        unset( $_SESSION['userEmail']);
        return false;
    }
}
