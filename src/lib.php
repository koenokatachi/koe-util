<?php

function _log_errors($level = E_ALL, $errorLog = 'error_log') {
	error_reporting($level);
	ini_set('display_errors', 0);
	ini_set('error_log', $errorLog);
	ini_set('log_errors', 1);
}

// Common for all prints
function _print($s = '') {
	print($s);
}

// Common for all eprints
function _eprint($s = '') {
	if (defined('STDERR')) {
		fputs(STDERR, $s);
	} else {
		_print($s);
	}
}

function _println($s = '') {
	_print($s . PHP_EOL);
}

function _eprintln($s = '') {
	_eprint($s . PHP_EOL);
}

function _json_println($data) {
	static $opt = null;

	if ($opt === null) {
		if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
			$opt = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
		} else {
			$opt = 0;
		}
	}

	_println(json_encode($data, $opt));
}

function _bye($s = '', $exitCode = 0) {
	_print($s);
	exit($exitCode);
}

function _ebye($s = '', $exitCode = 0) {
	_eprint($s);
	exit($exitCode);
}

function _byeln($s = '', $exitCode = 0) {
	_bye($s . PHP_EOL, $exitCode);
}

function _ebyeln($s = '', $exitCode = 0) {
	_ebye($s . PHP_EOL, $exitCode);
}

function _raise($message = '', $code = 0) {
	throw new Exception($message, $code);
}
