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

         $this->assertSame('2022-04-09 19:05:00',$this->arithmeticDates->getResult()->format('Y-m-d H:i:s'));
     }
}
