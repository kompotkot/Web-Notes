<?php

	include_once 'SQL.php';

	class User extends SQL {
		
		public $user_id, $user_login, $user_name, $user_password;

		public function getUser ($id) {
			
			return parent::Select('users', 'id', $id);
		}

		public function newUser ($name, $login, $password) {
			
			$object = [
				'name' => strip_tags($name),
				'login' => strip_tags($login),
				'password' => parent::Password(strip_tags($name), strip_tags($password))
			];
			$user = parent::Select('users', 'login', strip_tags($login));

			if (!$user) {
				parent::Insert('users', $object);
				return 'Successful registration!';
			} else {
				return 'User already registered!';
			}
		}

		public function login ($login, $password) {
			
			$user = parent::Select('users', 'login', strip_tags($login));

			if ($user) {
				if ($user['password'] == parent::Password($user['name'], strip_tags($password))) {
    				$_SESSION['user_id'] = $user['id'];
    				return 'Welcome, ' . $user['name'] . '!';
				} else {
					return 'Wrong password!';
				}
			} else {
				return 'User already registered!';
			}
		}

		public function logout () {
			
			if (isset($_SESSION["user_id"])) {
				unset($_SESSION["user_id"]);
				session_destroy();
				return true;
			} else {
				return false;
			}
		}
	}
?>