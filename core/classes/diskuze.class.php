<?php
class diskuze {
	private $tpl = null;
	private $web = null;
	private $userId = null;
	
	public function __construct() {
		$this->tpl = new web_Smarty;
		$this->web = new web;
	}

}
?>