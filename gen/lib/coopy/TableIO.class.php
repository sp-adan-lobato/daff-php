<?php

class coopy_TableIO {
	public function __construct() {}
	public function getContent($name) { if(!php_Boot::$skip_constructor) {
		return sys_io_File::getContent($name);
	}}
	public function saveContent($name, $txt) {
		sys_io_File::saveContent($name, $txt);
		return true;
	}
	public function args() {
		return Sys::args();
	}
	public function writeStdout($txt) {
		Sys::stdout()->writeString($txt);
	}
	public function writeStderr($txt) {
		Sys::stderr()->writeString($txt);
	}
	public function command($cmd, $args) {
		try {
			return Sys::command($cmd, $args);
		}catch(Exception $__hx__e) {
			$_ex_ = ($__hx__e instanceof HException) ? $__hx__e->e : $__hx__e;
			$e = $_ex_;
			{
				return 1;
			}
		}
	}
	public function async() {
		return false;
	}
	public function exists($path) {
		return file_exists($path);
	}
	function __toString() { return 'coopy.TableIO'; }
}
