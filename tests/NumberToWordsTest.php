<?php

declare(strict_types = 1);

namespace NumberToWords\Tests;

use NumberToWords\NumberToWords;

class NumberToWordsTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNull()
    {
        $a = new NumberToWords();

        $this->assertNull($a->convert('NaN')); // Not a Number
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getUnitsProvider
     */
    public function testUnits(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getTensProvider
     */
    public function testTens(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getTwentysProvider
     */
    public function testTwentys(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getHundredsProvider
     */
    public function testHundreds(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getNegativeAndPlusProvider
     */
    public function testNegativeAndPlus(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getThousandsProvider
     */
    public function testThousands(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getMillionsProvider
     */
    public function testMillions(string $number, string $expected)
    {
        $n = new NumberToWords();

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @return array
     */
    public function getUnitsProvider()
    {
        return [
            ['0', 'null'],
            ['1', 'eins'],
            ['2', 'zwei'],
            ['3', 'drei'],
            ['4', 'vier'],
            ['5', 'fünf'],
            ['6', 'sechs'],
            ['7', 'sieben'],
            ['8', 'acht'],
            ['9', 'neun'],
        ];
    }

    /**
     * @return array
     */
    public function getTensProvider()
    {
        return [
            ['10', 'zehn'],
            ['11', 'elf'],
            ['12', 'zwölf'],
            ['13', 'dreizehn'],
            ['14', 'vierzehn'],
            ['15', 'fünfzehn'],
            ['16', 'sechzehn'],
            ['17', 'siebzehn'],
            ['18', 'achtzehn'],
            ['19', 'neunzehn'],
        ];
    }

    /**
     * @return array
     */
    public function getTwentysProvider()
    {
        return [
            ['20', 'zwanzig'],
            ['21', 'einundzwanzig'],
            ['22', 'zweiundzwanzig'],
            ['23', 'dreiundzwanzig'],
            ['24', 'vierundzwanzig'],
            ['25', 'fünfundzwanzig'],
            ['26', 'sechsundzwanzig'],
            ['27', 'siebenundzwanzig'],
            ['28', 'achtundzwanzig'],
            ['29', 'neunundzwanzig'],
        ];
    }

    /**
     * @return array
     */
    public function getHundredsProvider()
    {
        return [
            ['100', 'einhundert'],
            ['101', 'einhunderteins'],
            ['110', 'einhundertzehn'],
            ['111', 'einhundertelf'],
            ['116', 'einhundertsechzehn'],
            ['133', 'einhundertdreiunddreißig'],
            ['160', 'einhundertsechzig'],
            ['190', 'einhundertneunzig'],
            ['199', 'einhundertneunundneunzig'],
            ['300', 'dreihundert'],
            ['699', 'sechshundertneunundneunzig'],
        ];
    }

    /**
     * @return array
     */
    public function getNegativeAndPlusProvider()
    {
        return [
            ['+1', 'eins'],
            ['-1', 'minus eins'],
            ['+42', 'zweiundvierzig'],
            ['-42', 'minus zweiundvierzig'],
            ['-699', 'minus sechshundertneunundneunzig'],
            ['-999', 'minus neunhundertneunundneunzig'],
        ];
    }

    /**
     * @return array
     */
    public function getThousandsProvider()
    {
        return [
            ['1000', 'eintausend'],
            ['1001', 'eintausendeins'],
            ['1999', 'eintausendneunhundertneunundneunzig'],
            ['1100', 'eintausendeinhundert'],
            ['1016', 'eintausendsechzehn'],
            ['4392', 'viertausenddreihundertzweiundneunzig'],
            ['1584', 'eintausendfünfhundertvierundachtzig'],
            ['5023', 'fünftausenddreiundzwanzig'],
            ['9433', 'neuntausendvierhundertdreiunddreißig']
        ];
    }

    /**
     * @return array
     */
    public function getMillionsProvider()
    {
        return [
            ['1000000', 'eine Million'],
            ['1000000000', 'eine Milliarde'],
            ['1000000000000', 'eine Billion'],
            ['4000000000000000005002388', 'vier Quadrillionen fünf Millionen zweitausenddreihundertachtundachtzig'],
            ['1' . str_repeat('0', 6000), 'eine Millinillion'],
            ['6' . str_repeat('0', 1800), 'sechs Trezentillionen'],
            ['1' . str_repeat('0', 59994), 'eine Nonillinovenonagintanongentillion'],
        ];
    }
}