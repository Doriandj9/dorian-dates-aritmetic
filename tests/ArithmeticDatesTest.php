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
     * @covers ArithmeticDates::format
     */

    public function isArithmeticDates()
    {
        $this->arithmeticDates = new ArithmeticDates('2022-05-15', 'America/Guayaquil');

        $this->assertSame('2022-05-15', $this->arithmeticDates->format('Y-m-d'));
    }

    /**
     * @test
     * @covers ArithmeticDates::format
     */

     public function moreHours(){
         $this->arithmeticDates = new ArithmeticDates(zoneHoraria:'America/Guayaquil');
         $this->arithmeticDates->setHourMinutesSeconds(0,59);

         $this->assertSame('2022-04-09 19:05:00',$this->arithmeticDates->getResult()->format('Y-m-d H:i:s'));
     }
}
