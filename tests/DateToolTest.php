<?php

use PHPUnit\Framework\TestCase;

require 'lib/DateTool.php';

class DateToolTest extends TestCase {

	public function testCountDays(){
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2017-08-31 18:00', DateTool::DAYS), 0);
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2017-08-31 18:01', DateTool::DAYS), 1);
	}

	public function testCountHours(){
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2017-08-31 19:00', DateTool::HOURS), 1);
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2017-08-31 19:01', DateTool::HOURS), 2);
	}

	public function testCountYears(){
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2018-08-31 18:00', DateTool::YEARS), 1);
		$this->assertEquals(DateTool::count('2017-08-31 18:00', '2017-09-30 19:01', DateTool::YEARS), 0);
	}

	public function testCountWeekdays() {
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-2 12:20'), 2);
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-2 12:50'), 3);
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-4 12:50'), 5);
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-6 12:50'), 5);
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-8 12:20'), 6);
		$this->assertEquals(DateTool::countWeekdays('2017-07-30 12:20', '2017-8-8 12:21'), 7);

		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-2 12:20'), 1);
		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-2 12:50'), 2);
		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-4 12:50'), 4);
		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-6 12:50'), 4);
		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-8 12:20'), 5);
		$this->assertEquals(DateTool::countWeekdays('2017-08-1 12:20', '2017-8-8 12:21'), 6);
	}

  public function testCountCompleteWeeks() {
    $this->assertEquals(DateTool::count('2017-07-30 00:00', '2017-8-6 00:00', DateTool::WEEKS), 1);
    $this->assertEquals(DateTool::count('2017-07-30 00:00', '2017-8-7 00:00', DateTool::WEEKS), 1);
    $this->assertEquals(DateTool::count('2017-07-29 09:00', '2017-8-7 00:00', DateTool::WEEKS), 1);
  }

  public function testIsBefore() {
    $this->assertEquals(DateTool::isBefore('2017-08-31 9:00 Australia/Adelaide', '2017-08-31 9:31 Australia/Sydney'), TRUE);
    $this->assertEquals(DateTool::isBefore('2017-08-31 9:00 Australia/Adelaide', '2017-08-31 9:20 Australia/Sydney'), FALSE);
  }

  public function testIsAfter() {
    $this->assertEquals(DateTool::isAfter('2017-08-31 9:00 Australia/Adelaide', '2017-08-31 9:31 Australia/Sydney'), FALSE);
    $this->assertEquals(DateTool::isAfter('2017-08-31 9:00 Australia/Adelaide', '2017-08-31 9:20 Australia/Sydney'), TRUE);
  }

}
