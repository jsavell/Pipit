<?php
namespace App\Classes\Controllers;
use App\Classes\Data as AppClasses;
use Core\Classes as Core;

class UserController extends Core\AbstractController {
	private $usersRepo;

	public function __construct(&$site) {
		parent::__construct($site);
		$this->usersRepo = $site->getDataRepository("Users");
		$this->site->getViewRenderer()->registerAppContextProperty("app_http", "{$this->site->getSiteConfig()['PATH_HTTP']}user.php");

		$this->getPage()->setTitle('User');

	}

	protected function update() {
		$data = $this->site->getSanitizedInputData();
		if (isset($data['user']) && $this->usersRepo->update($this->site->getGlobalUser()->getProfileValue("id"),$data['user'])) {
			$this->site->addSystemMessage('User updated');
		} else {
			$this->site->addSystemError('Error updating user');
		}
	}

	protected function edit() {
		$this->getPage()->setSubTitle('Edit Profile');
		$this->site->getViewRenderer()->registerViewVariable("user",$this->site->getGlobalUser()->getProfile());
		$this->setViewName('user.edit');
	}

	protected function login() {
		$data = $this->site->getSanitizedInputData();
		if ($data['user']['username'] && $data['user']['password']) {
			if ($this->site->getGlobalUser()->logIn($data['user']['username'],$data['user']['password'])) {
				header("Location:{$this->site->getSiteConfig()['PATH_HTTP']}");
			} else {
				$this->site->addSystemError('Invalid username/password combination');
				$this->setViewName("user.login");
			}
		} else {
			$this->site->addSystemError('Please provide both your username and password');
		}
	}

	protected function logout() {
		if ($this->site->getGlobalUser()->isLoggedIn()) {
			if ($this->site->getGlobalUser()->logOut()) {
				$this->site->addSystemMessage("You've been logged out");
				$this->setViewName("user.login");
			} else {
				$this->site->addSystemError('There was an error logging you out');
			}
		} else {
			$this->site->addSystemError("You don't seem to be logged in");
			$this->setViewName("user.login");
		}
	}

	protected function loadDefault() {
		if ($this->site->getGlobalUser()->isLoggedIn()) {
			$this->setViewName("user.info");
		} else {
			$this->setViewName("user.login");
		}
	}
}