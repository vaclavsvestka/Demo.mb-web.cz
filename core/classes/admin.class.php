<?php
class admin {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	private $uzivatele = null;
	
	public function __construct() {
        include_once CLASSES . "uzivatele.class.php";
		$this->tpl = new web_Smarty;
		$this->web = new web;
		$this->uzivatele = new uzivatele;
	}

	public function setUserId($id) {
		$this->userId = $id;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function updateUser() {
        $id = $this->getUserId();
		$datetime = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
        $data = array(
			'last_login' => $datetime, 
			'ip' => $ip, 
		);
		$this->web->editEntries('uzivatele', $data, 'id='.$id);		
	}

	public function addLoginTime() {
		$id = $this->getUserId();
		$datetime = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
			0, $id, $datetime, $ip
		);
		$this->web->addEntry('uzivatele_logins', $data);
	}

	public function login() {
		$name = $_POST['username'];
		$password = md5($_POST['password']);
		if($this->checkUserPass($name, $password) == true) {
			$_SESSION['timeout'] = 5;
			$_SESSION['logged'] = 1;
			$this->updateUser();
			$this->addLoginTime();
			$this->logged_user();
			header('Location: /admin');
		}
		else {
			$_SESSION['logged'] = 0;
			if($this->checkUsername($name) == false)  { $err = 1; }
			if($this->checkPassword($name, $password) == false)  { $err = 2; }
			header('Location: &err='.$err.'');
		}
	}

	public function checkUserPass($user, $pass) {
		$row = $this->web->getEntry("*,count(id) as pocet","uzivatele","username='".$user."' and password='".$pass."'");		
		if($row['pocet'] == 1) {
			$this->setUserId($row['id']);
			$_SESSION['userId'] = $row['id'];
			return true;
		}
		else {
			return false;
		}
	}

	public function logged_user() {
		$row = $this->web->getEntry("*","uzivatele","id='".$_SESSION['userId']."'");        
		$user = array();
		$user['id'] = $_SESSION['userId'];
		$user['admin_group'] = $row['admin_group'];
		$user['name'] = $row['name'];
		$user['surname'] = $row['surname'];
		$row2 = $this->web->getEntry('*','uzivatele_skupiny','id='.$row['admin_group']);
		$user['admin_group_text'] = $row2['name'];
		$user['prava'] = $this->uzivatele->prava_skupiny($row['admin_group']);
		return $user;
	}

	public function checkUsername($name) {
		$row = $this->web->getEntry("count(id),username","uzivatele","username='".$name."'");
		if($row['pocet']<1) {
			return false;
		}
		else {
			return true;
		}
	}

	public function checkPassword($name, $pass) {
		$row = $this->web->getEntry("count(id),username,password","uzivatele","username='".$name."'");
		if(($name == $row['username']) && ($pass != $row['password'])) {
			return false;
		}
		else {
			return true;
		}
	}

	public function logout() {
		session_destroy();
	}

	public function displayLogin() {
		$this->tpl->display(ROOT . 'admin/pages/admin/login.tpl');        
	}

}
?>