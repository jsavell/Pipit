<?php
namespace Core\Classes;
use Core\Interfaces as Interfaces;

/** 
*	The default implementation of the Logger interface.
* 	The active logger can be defined in the config file.
*
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

class LoggerLevel {
	private $name;
	private $phpErrorCode;
	public function __construct($name,$phpErrorCode) {
		$this->name = $name;
		$this->phpErrorCode = $phpErrorCode;
	}

	public function getName() {
		return $this->name;
	}

	public function getPhpErrorCode() {
		return $this->phpErrorCode;
	}
}

class CoreLogger implements Interfaces\Logger {
	private $loggerTypes = array();
	private $logLevel = 3;

	public function __construct() {
		array_push($this->loggerTypes,new LoggerLevel("info",E_USER_NOTICE),
									new LoggerLevel("debug",E_USER_NOTICE),
									new LoggerLevel("warn",E_USER_WARNING),
									new LoggerLevel("error",E_USER_ERROR));
	}

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
			trigger_error("** ".get_class($this)." ** {$entry[1]}",$this->loggerTypes[$entry[0]]->getPhpErrorCode());
		}
	}

	public function setLogLevel($logLevel) {
 		if (is_int($logLevel) && $logLevel <= count($this->loggerTypes)) {
			$this->logLevel = $logLevel;
			$this->debug("Log level was set to: {$this->loggerTypes[$logLevel]->getName()}");
		} else {
			$this->warn("Invalid Log Level was requested");
		}
	}
}
?>
