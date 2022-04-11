<?php

namespace Dates\Manejos\Test;

use Dates\Manejos\ArithmeticDates;
use PHPUnit\Framework\TestCase;

/**
 * @covers Dates\Manejos\ArithmeticDates
 */

class ArithmeticDatesTest extends TestCase
{
    protected $arithmeticDates;
    protected $arithmeticDatesA;
    protected $arithmeticDatesB;


    public function testIsArithmeticDates()
    {
        $this->arithmeticDates = new ArithmeticDates('2022-05-15', 'America/Guayaquil');

        $this->assertSame('2022-05-15', $this->arithmeticDates->format('Y-m-d'));
    }

    public function testMoreHours()
    {
        $this->arithmeticDates = new ArithmeticDates('2022-04-09 19:04:00', 'America/Guayaquil');
        $this->arithmeticDates->setHourMinutesSeconds(0, 0);

        $this->assertSame('2022-04-09 19:04:00', $this->arithmeticDates->getResult()->format('Y-m-d H:i:s'));
    }

    public function testIsHasInterval()
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
