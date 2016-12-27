<?php

declare(strict_types = 1);

namespace NumberToWords\Tests;

use NumberToWords\NumberToWords;

class NumberToWordsTest extends \PHPUnit_Framework_TestCase
{
    public function testNumbers()
    {
        $a = new NumberToWords();

        foreach ([
            'null' => '0',
            'eins' => '1',
            'zwei' => '2',
            'drei' => '3',
            'vier' => '4',
            'fünf' => '5',
            'sechs' => '6',
            'sieben' => '7',
            'acht' => '8',
            'neun' => '9',
            'zehn' => '10',
            'elf' => '11',
            'zwölf' => '12',
            'elf Komma drei eins zwei' => '11,312',
            'einundzwanzig' => '21',
            'eintausendeinhundertdreiunddreißig' => '1133',
            'einhunderteins' => '101',
            'eine Million dreihundertelf' => '1000311',
            'eine Milliarde' => '1000000000',
            'neun Millinillionen' => '9' . str_repeat('0', 6000),
                 ] as $k => $v)
        {
            $this->assertEquals($k, $a->convert($v));
        }
    }
}