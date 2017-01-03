<?php

declare(strict_types = 1);

namespace NumberToWords\Tests;

use NumberToWords\NumberToWords;

/**
 * Class NumberToWordsTest
 *
 * @author Patrick Schur <patrick_schur@outlook.de>
 * @package NumberToWords\Tests
 */
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
     * @param string $number
     * @param string $expected
     * @dataProvider getFloatingPointNumbersProvider
     */
    public function testFloatingPoint(string $number, string $expected)
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
            ['1' . str_repeat('0', 6000000), 'eine Millinillinillion'],
            ['1' . str_repeat('0', 462), 'eine Septenseptuagintillion'],
            ['1' . str_repeat('0', 138), 'eine Tresvigintillion'],
            ['1' . str_repeat('0', 516), 'eine Sexoktogintillion'],
            ['1' . str_repeat('0', 612), 'eine Duozentillion'],
            ['1' . str_repeat('0', 654), 'eine Novenzentillion'],
            ['1' . str_repeat('0', 4854), 'eine Novemoktingentillion'],
            ['1' . str_repeat('0', 828), 'eine Oktotrigintazentillion'],
            ['1' . str_repeat('0', 2418), 'eine Tresquadringentillion'],
            ['1' . str_repeat('0', 4836), 'eine Sexoktingentillion'],
            ['899' . str_repeat('0', 498), 'achthundertneunundneunzig Treoktogintillionen'],
        ];
    }

    /**
     * @return array
     */
    public function getFloatingPointNumbersProvider()
    {
        return [
            ['0,50', 'null Komma fünf'],
            ['-101,88', 'minus einhunderteins Komma acht acht'],
            ['39279,43000', 'neununddreißigtausendzweihundertneunundsiebzig Komma vier drei']
        ];
    }
}