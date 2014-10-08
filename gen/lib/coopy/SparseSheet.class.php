<?php

class coopy_SparseSheet {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$this->h = $this->w = 0;
	}}
	public $h;
	public $w;
	public $row;
	public $zero;
	public function resize($w, $h, $zero) {
		$this->row = new haxe_ds_IntMap();
		$this->nonDestructiveResize($w, $h, $zero);
	}
	public function nonDestructiveResize($w, $h, $zero) {
		$this->w = $w;
		$this->h = $h;
		$this->zero = $zero;
	}
	public function get($x, $y) {
		$cursor = $this->row->get($y);
		if($cursor === null) {
			return $this->zero;
		}
		$val = $cursor->get($x);
		if($val === null) {
			return $this->zero;
		}
		return $val;
	}
	public function set($x, $y, $val) {
		$cursor = $this->row->get($y);
		if($cursor === null) {
			$cursor = new haxe_ds_IntMap();
			$this->row->set($y, $cursor);
		}
		$cursor->set($x, $val);
	}
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->__dynamics[$m]) && is_callable($this->__dynamics[$m]))
			return call_user_func_array($this->__dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call <'.$m.'>');
	}
	function __toString() { return 'coopy.SparseSheet'; }
}
