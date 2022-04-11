<?php

namespace Dates\Manejos\Test;

use Dates\Manejos\ArithmeticDates;
use PHPUnit\Framework\TestCase;

/**
 * @uses ArArithmeticDates
 */
class ArithmeticDatesTest extends TestCase
{
    protected $arithmeticDates;
    /**
     * @test
     * @covers 
     */

    public function isArithmeticDates(): void
    {
        $this->arithmeticDates = new ArithmeticDates('2022-05-15', 'America/Guayaquil');

        $this->assertInstanceOf(ArithmeticDates::class,$this->arithmeticDates);
    }

    /**
     * @test
     * @covers 
     */

     public function moreHours(){
         $this->arithmeticDates = new ArithmeticDates(zoneHoraria:'America/Guayaquil');
         $this->arithmeticDates->setHourMinutesSeconds(0,59);


     /**
      * @test
      * @covers ArithmeticDates
      */

    public function isHasInterval()
    {
        $this->arithmeticDatesA = new ArithmeticDates('2022-02-15 00:00:00', 'America/Guayaquil');
        $this->arithmeticDatesB = new ArithmeticDates('2022-03-01 00:00:00', 'America/Guayaquil');
        $this->arithmeticDates = new ArithmeticDates('2022-02-25 00:00:00', 'America/Guayaquil');

        $this->assertSame(
            true,
            ArithmeticDates::hasInterval($this->arithmeticDatesA, $this->arithmeticDatesB, $this->arithmeticDates)
        );
    }

}
