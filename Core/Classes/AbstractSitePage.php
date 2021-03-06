<?php
namespace Core\Classes;
/** 
*	An abstract implementation of a SitePage
*	SitePages are used to define metadata like subaction options, titles and user security levels
*
*	@author Jason Savell <jsavell@library.tamu.edu>
*/

abstract class AbstractSitePage {
	protected $accessLevel;
	protected $name;
	protected $path;
	protected $title;
	protected $subTitle;
	protected $options = array();
	protected $isSearchable = false;
	protected $searchableFields = array();

	public function __construct($name,$path,$accessLevel) {
		$this->setName($name);
		$this->setPath($path);
		$this->setAccessLevel($accessLevel);
	}

	public function getAccessLevel() {
		return $this->accessLevel;
	}

	protected function setAccessLevel($accessLevel=0) {
		$this->accessLevel = $accessLevel;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getPath() {
		return $this->path;
	}

	public function setPath($path) {
		$this->path = $path;
	}

	abstract public function setTitle($title);
	abstract public function getTitle();
	abstract public function setSubTitle($subTitle);
	abstract public function getSubTitle();
	abstract public function getOptions();
	abstract public function setOptions($options);
	abstract public function setIsSearchable($isSearchable);
	abstract public function isSearchable();
	abstract public function setSearchableFields($searchableFields);
	abstract public function getSearchableFields();
}
?>