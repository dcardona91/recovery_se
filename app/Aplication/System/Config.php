<?php
namespace ThisApp\Aplication\System;

class Config{
/**
 * @type array
 */

	private static $globals = array(
			'mysql' => array(
				'host' =>  'localhost',
				'username'=> 'recovery_searchu',
				'password' => 's34rch_2018.',
				'db' => 'recovery_search'
				),
			'remember' => array(
				'cookie_name' => 'hash',
				'cookie_expiry' => 604800
				),
			'system' => array(
				'domain' => '',
				'root' => 'public',
				'home' => 'welcome',
				'errors' => array('404','500','403'),
				'enc_method' => 'aes-128-cbc',
				'enc_pass' => 'tr3b0l2018c3ntr0d31nn0v4c10n',
				'metas'=> array(
						'title' => 'ele',
						'description' => 'A site made with ele Framework',
						'image' => '',
						'url' => '',
						)
				),
			'mailgun' => array(
				'api_key' => '',
				'domain' => ''
				),
			'session' => array(
				'session_name' => 'user',
				'token_name' => 'token',
				'user_name' => 'name',
				'user_rol' => 'rol',
				'user_mail' => 'mail',
				'flash_msg' => 'flash',
				'menu_sent' => 'menu'
				)
			);

	public static function get($path = null){
		if ($path) {
			$config = self::$globals;
			$path = explode('/', $path);
			foreach ($path as $bit) {
				if (isset($config[$bit])) {
					$config = $config[$bit];
				}
			}
			return $config;
		}

		return false;
	}
}
