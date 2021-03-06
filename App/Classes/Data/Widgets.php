<?php
namespace App\Classes\Data;
use Core\Classes\Data as CoreData;
/** 
*	Repo for managing Widgets
*	Intended as a starting point for developing application specific DAOs
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

class Widgets extends CoreData\AbstractDataBaseRepository {
	public function __construct() {
		parent::__construct('widgets','id','name');
	}

	public function getPartsByWidgetId($widgetId) {
		$sql = "SELECT * FROM {$this->primaryTable}_parts WHERE widgetid=:widgetid";
		return $this->queryWithIndex($sql,'id',NULL,array("widgetid"=>$widgetId));
	}

	public function addPartToWidget($widgetId,$part) {
		$part['widgetid'] = $widgetId;
		return $this->buildInsertStatement($part,"{$this->primaryTable}_parts");
	}

	public function removePartById($partId) {
		$sql = "DELETE FROM {$this->primaryTable}_parts WHERE id=:partid";
		return $this->executeUpdate($sql,array(":partid"=>$partId));
	}
}