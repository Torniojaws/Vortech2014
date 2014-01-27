<?php
	include('classes/class-form.php');
	
	class Admin {
		private $loggedIn;
		
		public function __construct($adminLoginStatus) {
			if($adminLoginStatus == 'loginOK') {
				$this->loggedIn = true;
			} else {
				$this->loggedIn = false;
			}
		}
		
		public function isLogged() {
			return $this->loggedIn;
		}
		
		public function displayLogin() {
			$form = new Form('contents/adminLogin.php');
			$form->addCaption('Username:');
			$form->addTextInput('name');
			$form->addCaption('Password');
			$form->addPasswordInput('pass');
			$form->addSubmit('submit', 'Login');
			$form->ready();
		}
		
		public function logoutButton() {
			echo 'Logged in as <b>', $_SESSION['adminName'], '</b>';
			$logout = new Form('?page=admin');
			$logout->addSubmit('logout', 'Logout');
			$logout->ready();
		}
	}
	
?>