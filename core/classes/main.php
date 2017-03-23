<?php  
	class main {
		public $tpl = null;
		public $web = null;
		
		public function __construct() {
			$this->tpl = new web_Smarty;
			$this->web = new web;
		}
	}
?>