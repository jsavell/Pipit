<?php
namespace Core\Utilities;

class LDAPConnector {
	private $url;
	private $port;

	private $user;
	private $password;

	private $handle;

	function __construct($url=NULL,$port=NULL,$user=NULL,$password=NULL) {

		$this->ldapServer['url'] = $GLOBALS['config']['LDAP_URL'];
		$this->ldapServer['port'] = $GLOBALS['config']['LDAP_PORT'];
		$this->ldapServer['user'] = $GLOBALS['config']['LDAP_USER'];
		$this->ldapServer['password'] = $GLOBALS['config']['LDAP_PASSWORD'];

		$this->url = ($url) ?$url:$GLOBALS['config']['LDAP_URL'];
		$this->port = ($port) ? $port:$GLOBALS['config']['LDAP_PORT'];
		if ($user) {
			$this->setProperty('user',$user);
		} elseif ($GLOBALS['config']['LDAP_USER']) {
			$this->setProperty('user',$GLOBALS['config']['LDAP_USER']);
		}
		if ($password) {
			$this->setProperty('password',$password);
		} elseif ($GLOBALS['config']['LDAP_USER']) {
			$this->setProperty('password',$GLOBALS['config']['LDAP_PASSWORD']);
		}
	}

	public function getConnection() {
		if ($this->handle) {
			return $this->handle;
		} else {
			$this->handle = ldap_connect($this->url, $this->port);
			if ($this->handle) {
				//todo: make set_options configurable
				ldap_set_option($this->handle, LDAP_OPT_PROTOCOL_VERSION, 3);
				ldap_set_option($this->handle, LDAP_OPT_REFERRALS, 0);
				if ($this->user && $this->password) {
					if ($this->bind()) {
						return $this->handle;
					}
				} else {
					return $this->handle;
				}
			}
		}
		return false;
	}

	private function bind() {
		return ldap_bind($this->handle, $this->user, $this->password);
	}

	protected function setProperty($name,$value) {
		$this->$name = $value;
	}

	protected function getProperty($name) {
		return $this->$name;
	}
}