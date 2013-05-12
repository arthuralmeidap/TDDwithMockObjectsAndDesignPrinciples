<?php

namespace TDDMicroExercises\TirePressureMonitoringSystem\Tests;

class AlarmTest extends \PHPUnit_Framework_TestCase 
{
	public function testAutoLoad()
	{
		$instance = new \TDDMicroExercises\TirePressureMonitoringSystem\Alarm();
		$this->assertInstanceOf('\TDDMicroExercises\TirePressureMonitoringSystem\Alarm', $instance);
	}
}