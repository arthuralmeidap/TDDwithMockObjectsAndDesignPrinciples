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
		$normalPressure = Alarm::HIGH_PRESSURE_TRESHOLD - 1;
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue($normalPressure));

		$this->alarm->check();
		$this->assertFalse($this->alarm->alarmOn());
	}

	public function testWhenPressureIsHighkTheAlarmShouldBeOn()
	{
		$highPressure = Alarm::HIGH_PRESSURE_TRESHOLD + 1;
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue($highPressure));

		$this->alarm->check();
		$this->assertTrue($this->alarm->alarmOn());
	}

	public function testWhenPressureIsLowkTheAlarmShouldBeOn()
	{
		$lowPressure = Alarm::LOW_PRESSURE_TRESHOLD - 1;
		$this->mockSensor->expects($this->once())
							->method('popNextPressurePsiValue')
							->will($this->returnValue($lowPressure));

		$this->alarm->check();
		$this->assertTrue($this->alarm->alarmOn());
	}
}