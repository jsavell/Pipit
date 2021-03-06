<?php
namespace App\Classes\Controllers;
use Core\Classes as Core;

class DefaultAdminController extends Core\AbstractController {
	public function __construct(&$site) {
		$this->requireAdmin = true;
		parent::__construct($site);
	}
	
	protected function loadDefault() {
		$this->setViewName("default");
	}
}