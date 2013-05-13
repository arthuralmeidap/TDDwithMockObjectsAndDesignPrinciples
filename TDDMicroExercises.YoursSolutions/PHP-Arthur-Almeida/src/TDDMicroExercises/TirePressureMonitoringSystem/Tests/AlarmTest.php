<?php

namespace TDDMicroExercises\TirePressureMonitoringSystem\Tests;

use TDDMicroExercises\TirePressureMonitoringSystem\Alarm;
use TDDMicroExercises\TirePressureMonitoringSystem\ISensor;

class AlarmTest extends \PHPUnit_Framework_TestCase 
{
	private $alarm;
	private $mockSensor;

	public function setUp()
	{
		$this->mockSensor = $this->getMock('\TDDMicroExercises\TirePressureMonitoringSystem\ISensor');
		$this->alarm = new Alarm($this->mockSensor);
	}

	public function testWhenPressureIsOkTheAlarmShouldBeOff()
	{
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue(20));

		$this->alarm->check();
		$this->assertFalse($this->alarm->alarmOn());
	}

	public function testWhenPressureIsHighkTheAlarmShouldBeOn()
	{
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue(30));

		$this->alarm->check();
		$this->assertTrue($this->alarm->alarmOn());
	}

	public function testWhenPressureIsLowkTheAlarmShouldBeOn()
	{
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue(10));

		$this->alarm->check();
		$this->assertTrue($this->alarm->alarmOn());
	}
}