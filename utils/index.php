<?php
require('./utils/bd/Conection.php');
require('./utils/bd/ORM.php');
require('./utils/bd/Model.php');

function encrypt($pass)
{
	$len = strlen($pass);
	$rs = "";
	for ($i = 0; $i < $len; $i++) {
		$rs .= ($i % 2) != 0 ? md5($pass[$i] . SECRET_KEY) : $i;
	}
	return hash('sha512', ($rs));
};

function sessionStatus()
{
	return (function_exists("session_status")) ? session_status() : session_id();
};

function is_authenticated()
{
	return sessionLocal('is_authenticated') ? true : false;
};

function sessionLocal($a = null, $b = null)
{
	$r = true;
	if (sessionStatus() == 1) {
		session_start();
	}
	if (!empty($a)) {
		if (empty($b)) {
			$r = (isset($_SESSION[$a])) ? $_SESSION[$a] : null;
		} else {
			$_SESSION[$a] = $b;
		}
	}
	return $r;
};
