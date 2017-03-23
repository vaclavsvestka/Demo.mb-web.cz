<?php
require(CLASSES . 'web.lib.php');
require(SMARTY . 'Smarty.class.php');

// smarty configuration
class Web_Smarty extends Smarty {
    function __construct() {
      parent::__construct();
      $this->setTemplateDir(ROOT . 'www/templates');
      $this->setCompileDir(ROOT . 'www/smarty/templates_c');
      $this->setConfigDir(ROOT . 'www/smarty/configs');
      $this->setCacheDir(ROOT . 'www/smarty/cache');
    }
}
      
?>