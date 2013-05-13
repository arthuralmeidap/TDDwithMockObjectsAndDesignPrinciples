<?php

namespace TDDMicroExercises\TirePressureMonitoringSystem;

class Alarm
{
	const LOW_PRESSURE_TRESHOLD 	= 17;
	const HIGH_PRESSURE_TRESHOLD 	= 21;

	private $sensor;
	private $alarmOn;
	private $alarmCount;

	public function __construct( $sensor = null ) {
		if(is_null($sensor)) {
			$this->sensor 		= new Sensor();
		}else{
			$this->sensor 		= $sensor;
		}
		$this->alarmOn 		= false;
		$this->alarmCount	= 0;
	}


	public function check() 
	{
		$psiPressureValue = $this->sensor->popNextPressurePsiValue();

		if (!$this->isPressureNormal($psiPressureValue)) {

			$this->alarmOn = true;
			$this->alarmCount += 1;
		}
	}

	public function alarmOn() 
	{
		return $this->alarmOn;
	}

	private function isPressureNormal($psiPressureValue){
		return ($psiPressureValue >= Alarm::LOW_PRESSURE_TRESHOLD
			&& $psiPressureValue <= Alarm::HIGH_PRESSURE_TRESHOLD );
	}
}