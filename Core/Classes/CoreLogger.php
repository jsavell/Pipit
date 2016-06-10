<?php
namespace Core\Classes;
use Core\Interfaces as Interfaces;

/** 
*	An abstract implementation of the Logger interface
*
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

class CoreLogger implements Interfaces\Logger {
	private $loggerTypes = array("info","debug","warn","error");
	private $logLevel = 3;

	public function info($message) {
		$this->writeToLog(array(0,$message));
	}
	public function debug($message) {
		$this->writeToLog(array(1,$message));
	}
	public function warn($message) {
		$this->writeToLog(array(2,$message));
	}

	public function error($message) {
		$this->writeToLog(array(3,$message));
	}

	protected function writeToLog($entry) {
		if ($entry[0] >= $this->logLevel) {
			error_log("**** ".get_class($this)." - {$this->loggerTypes[$entry[0]]}: {$entry[1]} ****");
		}
	}

	public function setLogLevel($logLevel) {
 		if (is_int($logLevel) && $logLevel <= count($this->loggerTypes)) {
			$this->logLevel = $logLevel;
		} else {
			$this->error("Invalid Log Level");
		}
	}
}
?>