<?php
class User {
	public $Id = false;
	public $Login = false;
	public $Name = false;
	public $Role = false;
	public $Status = false;
	public $Email = false;
	public $Picture = false;
	public static $globalRole = null;

	public function __construct() {

		if(isset($_GET['logout'])) {
			self::Logout();
		}
		if(isset($_SESSION['hash'])) {
			$result = dB::getUserByHash($_SESSION['hash']);
			if($result) {
				$this->Id = $result['id']; 
				$this->Login = $result['login']; 
				$this->Name = $result['name']; 
				$this->Role = $result['role']; 
				$this->Status = $result['status']; 
				$this->Email = $result['email']; 
				$this->Picture = $result['picture'];
				self::$globalRole = $result['role'];
			}
		}
	}

	public static function generateHash($password) {
		
		$salt = '$2y$11$'.substr(md5(uniqid(rand(), true)), 0, 22);
		
		return crypt($password, $salt);
	}

	public function Welcome() {
		
		$result = '<a href="/login/">Вход</a>';
		if($this->Role) {
			$result = '<a href="/logout/?logout=yes">Выход</a>';
			if($this->Role > 1) {
                            $result = '<a href="/admin/">Админ Панель</a> | '.$result;
                        }
		}
		
		return $result;
	}

	public static function Logout() {
		
		unset($_GET['logout']);
		unset($_SESSION['hash']);
		Engine::DirectLink('/');

		return true;
	}
	
	
	
}