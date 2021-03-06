<?php
namespace App\Classes\Controllers;
use App\Classes\Data as AppData;
use Core\Classes as Core;

class UsersAdminController extends Core\AbstractController {
	private $usersRepo;

	public function __construct(&$site) {
		$this->requireAdmin = true;
		parent::__construct($site);

		$this->usersRepo = $site->getDataRepository("Users");

		$this->getPage()->setTitle("Manage Users");
		$this->getPage()->setOptions(array(
								array("name"=>"list"),
								array("name"=>"add","action"=>"add","modal"=>true)));
		$this->getPage()->setIsSearchable(true);
		$this->getPage()->setSearchableFields(array(array("name"=>"name_last","type"=>"text"),
								array("name"=>"name_first","type"=>"text")));

	}

	protected function search() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['term'])) {
			$this->site->getViewRenderer()->registerViewVariable("users",$this->usersRepo->search($data['term']));
			$this->setViewName("users.list");
		} elseif (isset($data['advancedsearch'])) {
			$site->getViewRenderer()->registerViewVariable("users",$this->usersRepo->searchAdvanced($data['advancedsearch']));
			$this->setViewName("users.list");
		} else {
			$this->site->addSystemError('There was an error with the search');
		}
	}


	protected function disable() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['id']) && is_numeric($data['id']) && $this->usersRepo->disableById($data['id'])) {
			$this->site->addSystemMessage('User disabled');
		} else {
			$this->site->addSystemError('Error disabling user');
		}
	}

	protected function enable() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['id']) && is_numeric($data['id']) && $this->usersRepo->enableById($data['id'])) {
			$this->site->addSystemMessage('User enabled');
		} else {
			$this->site->addSystemError('Error enabling user');
		}
	}

	protected function insert() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['user']) && $this->usersRepo->add($data['user'])) {
			$this->site->addSystemMessage('User added');
		} else {
			$this->site->addSystemError('Error adding usert');
		}
	}

	protected function add() {
		$this->getPage->setSubTitle('New User');
		$this->setViewName("users.add");
	}

	protected function update() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['user']) && (isset($data['id']) && is_numeric($data['id'])) && $this->usersRepo->update($data['id'],$data['user'])) {
			$this->site->addSystemMessage('User updated');
		} else {
			$this->site->addSystemError('Error updating user');
		}
	}

	protected function edit() {
		$data = $this->site->getSanitizedInputData();
		$this->getPage()->setSubTitle('Update User');
		if (isset($data['id']) && is_numeric($data['id'])) {
			$this->site->getViewRenderer()->registerViewVariable("user",$this->usersRepo->getById($data['id']));
			$this->setViewName("users.edit");
		}		
	}

	protected function loadDefault() {
		$this->getPage()->setSubTitle('Users');
	 	$this->site->getViewRenderer()->registerViewVariable("users",$this->usersRepo->get());
		$this->setViewName("users.list");
	}


}