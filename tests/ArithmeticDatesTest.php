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
        $this->arithmeticDates = new ArithmeticDates('2022-05-15', zoneHoraria:'America/Guayaquil');

        $this->assertSame('2022-05-15', $this->arithmeticDates->format('Y-m-d'));
    }
}
