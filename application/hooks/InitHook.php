<?php
class InitHook {
	var $CI,$isLoggedIn;
	function __construct() {
		$this->CI = NULL;
	}
	
	/**
	 * SSL or Non SSL requests
	 */
	function redirect_ssl() {
		$class = $this->CI->router->fetch_class();		
		$exclude =  array('');  // add more controller name to exclude ssl.
		if(!in_array($class,$exclude)) {		  
			if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') { // redirecting to ssl
				$this->CI->config->config['base_url'] = str_replace('http://', 'https://', $this->CI->config->config['base_url']);
				redirect($this->CI->uri->uri_string());
				exit();
			}
		} else {
			// redirecting with no ssl.
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
				$this->CI->config->config['base_url'] = str_replace('https://', 'http://', $this->CI->config->config['base_url']);
				redirect($this->CI->uri->uri_string());
				exit();
			}
		}
	}
}
?>