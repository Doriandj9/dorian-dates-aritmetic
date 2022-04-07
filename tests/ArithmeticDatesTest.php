<?php

namespace Dates\Manejos\Test;

use Dates\Manejos\ArithmeticDates;
use DateTime;
use PHPUnit\Framework\TestCase;

class ArithmeticDatesTest extends TestCase
{
    /**
     * @test
     */

    public function isArithmeticDates()
    {
        $date = new ArithmeticDates('2022-05-15', zoneHoraria:'America/Guayaquil');

        $this->assertSame(new ArithmeticDates('2022-05-15', zoneHoraria:'America/Guayaquil'), $date);
    }
}
