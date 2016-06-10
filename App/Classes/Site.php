<?php
namespace App\Classes;
use Core\Classes as CoreClasses;
/** 
*	The primary site manager
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

class Site extends CoreClasses\AbstractSite {
	protected $logger;

	public function addSystemMessage($message,$type="info") {
		$this->systemMessages[] = new SystemMessage($message,$type);
	}

	public function addSystemError($message) {
		$this->addSystemMessage($message,'error');
	}

	public function getSystemMessages() {
		return $this->systemMessages;
	}

	public function setLogger(&$logger) {
		$this->logger = $logger;
	}

	public function getLogger() {
		return $this->logger;
	}
}