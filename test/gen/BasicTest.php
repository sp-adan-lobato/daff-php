<?php

class harness_BasicTest extends haxe_unit_TestCase {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public $data1;
	public $data2;
	public function setup() {
		$this->data1 = (new _hx_array(array((new _hx_array(array("Country", "Capital"))), (new _hx_array(array("Ireland", "Dublin"))), (new _hx_array(array("France", "Paris"))), (new _hx_array(array("Spain", "Barcelona"))))));
		$this->data2 = (new _hx_array(array((new _hx_array(array("Country", "Code", "Capital"))), (new _hx_array(array("Ireland", "ie", "Dublin"))), (new _hx_array(array("France", "fr", "Paris"))), (new _hx_array(array("Spain", "es", "Madrid"))), (new _hx_array(array("Germany", "de", "Berlin"))))));
	}
	public function testBasic() {
		$table1 = harness_Native::table($this->data1);
		$table2 = harness_Native::table($this->data2);
		$alignment = coopy_Coopy::compareTables($table1, $table2, null)->align();
		$data_diff = (new _hx_array(array()));
		$table_diff = harness_Native::table($data_diff);
		$flags = new coopy_CompareFlags();
		$highlighter = new coopy_TableDiff($alignment, $flags);
		$highlighter->hilite($table_diff);
		$this->assertEquals("" . Std::string($table_diff->getCell(0, 4)), "->", _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 30, "className" => "harness.BasicTest", "methodName" => "testBasic")));
	}
	public function testNamedID() {
		$table1 = harness_Native::table($this->data1);
		$table2 = harness_Native::table($this->data2);
		$flags = new coopy_CompareFlags();
		$flags->addPrimaryKey("Capital");
		$alignment = coopy_Coopy::compareTables($table1, $table2, $flags)->align();
		$data_diff = (new _hx_array(array()));
		$table_diff = harness_Native::table($data_diff);
		$highlighter = new coopy_TableDiff($alignment, $flags);
		$highlighter->hilite($table_diff);
		$this->assertEquals("" . Std::string($table_diff->getCell(3, 6)), "Barcelona", _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 43, "className" => "harness.BasicTest", "methodName" => "testNamedID")));
	}
	public function testCSV() {
		$txt = "name,age\x0APaul,\"7,9\"\x0A\"Sam\x0ASpace\",\"\"\"\"\x0A";
		$tab = harness_Native::table((new _hx_array(array())));
		$csv = new coopy_Csv(null);
		$csv->parseTable($txt, $tab);
		$this->assertEquals(3, $tab->get_height(), _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 51, "className" => "harness.BasicTest", "methodName" => "testCSV")));
		$this->assertEquals(2, $tab->get_width(), _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 52, "className" => "harness.BasicTest", "methodName" => "testCSV")));
		$this->assertEquals("Paul", $tab->getCell(0, 1), _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 53, "className" => "harness.BasicTest", "methodName" => "testCSV")));
		$this->assertEquals("\"", $tab->getCell(1, 2), _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 54, "className" => "harness.BasicTest", "methodName" => "testCSV")));
	}
	public function testEmpty() {
		$table1 = harness_Native::table($this->data1);
		$table2 = harness_Native::table((new _hx_array(array())));
		$alignment = coopy_Coopy::compareTables($table1, $table2, null)->align();
		$data_diff = (new _hx_array(array()));
		$table_diff = harness_Native::table($data_diff);
		$flags = new coopy_CompareFlags();
		$highlighter = new coopy_TableDiff($alignment, $flags);
		$highlighter->hilite($table_diff);
		$table3 = $table1->hclone();
		$patcher = new coopy_HighlightPatch($table3, $table_diff);
		$patcher->apply();
		$this->assertEquals(0, $table3->get_height(), _hx_anonymous(array("fileName" => "BasicTest.hx", "lineNumber" => 69, "className" => "harness.BasicTest", "methodName" => "testEmpty")));
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
	function __toString() { return 'harness.BasicTest'; }
}
