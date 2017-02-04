<?php

declare(strict_types = 1);

namespace NumberToWords\Tests;

use NumberToWords\NumberToWords;
use NumberToWords\Locale\German;
use PHPUnit\Framework\TestCase;

/**
 * Class GermanTest
 *
 * @author Patrick Schur <patrick_schur@outlook.de>
 * @package NumberToWords\Tests
 */
class GermanTest extends TestCase
{
    public function testIsNull()
    {
        $n = new NumberToWords(new German());

        $this->assertNull($n->convert('NaN')); // Not a Number
    }

    /**
     * @expectedException \LengthException
     */
    public function testLargeNumberException()
    {
        $n = new NumberToWords(new German());

        $n->nameOfLargeNumber(0);
    }

    /**
     * @param int $number
     * @param string $expected
     * @dataProvider largeNumberProvider
     */
    public function testLargeNumbers(int $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->nameOfLargeNumber($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getUnitsProvider
     */
    public function testUnits(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getTensProvider
     */
    public function testTens(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getHundredsProvider
     */
    public function testHundreds(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getNegativeAndPlusProvider
     */
    public function testNegativeAndPlus(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getThousandsProvider
     */
    public function testThousands(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getMillionsProvider
     */
    public function testMillions(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getFloatingPointNumbersProvider
     */
    public function testFloatingPoint(string $number, string $expected)
    {
        $n = new NumberToWords(new German());

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
            ['30', 'dreißig'],
            ['31', 'einunddreißig'],
            ['32', 'zweiunddreißig'],
            ['33', 'dreiunddreißig'],
            ['34', 'vierunddreißig'],
            ['35', 'fünfunddreißig'],
            ['36', 'sechsunddreißig'],
            ['37', 'siebenunddreißig'],
            ['38', 'achtunddreißig'],
            ['39', 'neununddreißig'],
            ['40', 'vierzig'],
            ['41', 'einundvierzig'],
            ['42', 'zweiundvierzig'],
            ['43', 'dreiundvierzig'],
            ['44', 'vierundvierzig'],
            ['45', 'fünfundvierzig'],
            ['46', 'sechsundvierzig'],
            ['47', 'siebenundvierzig'],
            ['48', 'achtundvierzig'],
            ['49', 'neunundvierzig'],
            ['50', 'fünfzig'],
            ['51', 'einundfünfzig'],
            ['52', 'zweiundfünfzig'],
            ['53', 'dreiundfünfzig'],
            ['54', 'vierundfünfzig'],
            ['55', 'fünfundfünfzig'],
            ['56', 'sechsundfünfzig'],
            ['57', 'siebenundfünfzig'],
            ['58', 'achtundfünfzig'],
            ['59', 'neunundfünfzig'],
            ['60', 'sechzig'],
            ['61', 'einundsechzig'],
            ['62', 'zweiundsechzig'],
            ['63', 'dreiundsechzig'],
            ['64', 'vierundsechzig'],
            ['65', 'fünfundsechzig'],
            ['66', 'sechsundsechzig'],
            ['67', 'siebenundsechzig'],
            ['68', 'achtundsechzig'],
            ['69', 'neunundsechzig'],
            ['70', 'siebzig'],
            ['71', 'einundsiebzig'],
            ['72', 'zweiundsiebzig'],
            ['73', 'dreiundsiebzig'],
            ['74', 'vierundsiebzig'],
            ['75', 'fünfundsiebzig'],
            ['76', 'sechsundsiebzig'],
            ['77', 'siebenundsiebzig'],
            ['78', 'achtundsiebzig'],
            ['79', 'neunundsiebzig'],
            ['80', 'achtzig'],
            ['81', 'einundachtzig'],
            ['82', 'zweiundachtzig'],
            ['83', 'dreiundachtzig'],
            ['84', 'vierundachtzig'],
            ['85', 'fünfundachtzig'],
            ['86', 'sechsundachtzig'],
            ['87', 'siebenundachtzig'],
            ['88', 'achtundachtzig'],
            ['89', 'neunundachtzig'],
            ['90', 'neunzig'],
            ['91', 'einundneunzig'],
            ['92', 'zweiundneunzig'],
            ['93', 'dreiundneunzig'],
            ['94', 'vierundneunzig'],
            ['95', 'fünfundneunzig'],
            ['96', 'sechsundneunzig'],
            ['97', 'siebenundneunzig'],
            ['98', 'achtundneunzig'],
            ['99', 'neunundneunzig'],
        ];
    }

    /**
     * @return array
     */
    public function getHundredsProvider()
    {
        return [
            ['100', 'einhundert'],
            ['200', 'zweihundert'],
            ['300', 'dreihundert'],
            ['400', 'vierhundert'],
            ['500', 'fünfhundert'],
            ['600', 'sechshundert'],
            ['700', 'siebenhundert'],
            ['800', 'achthundert'],
            ['900', 'neunhundert'],
            ['101', 'einhunderteins'],
            ['110', 'einhundertzehn'],
            ['111', 'einhundertelf'],
            ['112', 'einhundertzwölf'],
            ['113', 'einhundertdreizehn'],
            ['114', 'einhundertvierzehn'],
            ['115', 'einhundertfünfzehn'],
            ['116', 'einhundertsechzehn'],
            ['117', 'einhundertsiebzehn'],
            ['118', 'einhundertachtzehn'],
            ['119', 'einhundertneunzehn'],
            ['120', 'einhundertzwanzig'],
            ['199', 'einhundertneunundneunzig'],
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
            ['2000', 'zweitausend'],
            ['3000', 'dreitausend'],
            ['4000', 'viertausend'],
            ['5000', 'fünftausend'],
            ['6000', 'sechstausend'],
            ['7000', 'siebentausend'],
            ['8000', 'achttausend'],
            ['9000', 'neuntausend'],
            ['10000', 'zehntausend'],
            ['100000', 'einhunderttausend'],
            ['1001', 'eintausendeins'],
            ['1002', 'eintausendzwei'],
            ['1010', 'eintausendzehn'],
            ['1011', 'eintausendelf'],
            ['1016', 'eintausendsechzehn'],
            ['1100', 'eintausendeinhundert'],
            ['1101', 'eintausendeinhunderteins'],
            ['1110', 'eintausendeinhundertzehn'],
            ['1111', 'eintausendeinhundertelf'],
            ['1999', 'eintausendneunhundertneunundneunzig'],
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
            ['2000000', 'zwei Millionen'],
            ['1000000000', 'eine Milliarde'],
            ['3000000000', 'drei Milliarden'],
            ['1000000000000', 'eine Billion'],
            ['4000000000000', 'vier Billionen'],
            ['1000000000000000', 'eine Billiarde'],
            ['5000000000000000', 'fünf Billiarden'],
            ['1000000000000000000', 'eine Trillion'],
            ['6000000000000000000', 'sechs Trillionen'],
        ];
    }

    /**
     * @return array
     */
    public function getFloatingPointNumbersProvider()
    {
        return [
            ['0,50', 'null Komma fünf'],
            ['-0,50', 'minus null Komma fünf'],
            ['-101,88', 'minus einhunderteins Komma acht acht'],
            ['39279,43000', 'neununddreißigtausendzweihundertneunundsiebzig Komma vier drei']
        ];
    }

    /**
     * @return array
     */
    public function largeNumberProvider()
    {
        return [
            [6, 'Million'],
            [9, 'Milliarde'],
            [12, 'Billion'],
            [15, 'Billiarde'],
            [18, 'Trillion'],
            [21, 'Trilliarde'],
            [24, 'Quadrillion'],
            [27, 'Quadrilliarde'],
            [138, 'Tresvigintillion'],
            [462, 'Septenseptuagintillion'],
            [498, 'Treoktogintillion'],
            [516, 'Sexoktogintillion'],
            [600, 'Zentillion'],
            [612, 'Duozentillion'],
            [654, 'Novenzentillion'],
            [828, 'Oktotrigintazentillion'],
            [900, 'Quinquagintazentillion'],
            [1800, 'Trezentillion'],
            [2418, 'Tresquadringentillion'],
            [4836, 'Sexoktingentillion'],
            [4854, 'Novemoktingentillion'],
            [6000, 'Millinillion'],
            [59994, 'Nonillinovenonagintanongentillion'],
            [6000000, 'Millinillinillion'],
        ];
    }
}
