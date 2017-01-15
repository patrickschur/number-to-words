<?php

declare(strict_types = 1);

namespace NumberToWords\Tests;

use NumberToWords\NumberToWords;
use NumberToWords\Locale\English;

/**
 * Class GermanTest
 *
 * @author Patrick Schur <patrick_schur@outlook.de>
 * @package NumberToWords\Tests
 */
class EnglishTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNull()
    {
        $n = new NumberToWords(new English());

        $this->assertNull($n->convert('NaN')); // Not a Number
    }

    /**
     * @expectedException \LengthException
     */
    public function testLargeNumberException()
    {
        $n = new NumberToWords(new English());

        $n->nameOfLargeNumber(0);
    }

    /**
     * @param int $number
     * @param string $expected
     * @dataProvider largeNumberProvider
     */
    public function testLargeNumbers(int $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->nameOfLargeNumber($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getUnitsProvider
     */
    public function testUnits(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getTensProvider
     */
    public function testTens(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getTwentysProvider
     */
    public function testTwentys(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getHundredsProvider
     */
    public function testHundreds(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getNegativeAndPlusProvider
     */
    public function testNegativeAndPlus(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getThousandsProvider
     */
    public function testThousands(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getMillionsProvider
     */
    public function testMillions(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @param string $number
     * @param string $expected
     * @dataProvider getFloatingPointNumbersProvider
     */
    public function testFloatingPoint(string $number, string $expected)
    {
        $n = new NumberToWords(new English());

        $this->assertEquals($expected, $n->convert($number));
    }

    /**
     * @return array
     */
    public function getUnitsProvider()
    {
        return [
            ['0', 'zero'],
            ['1', 'one'],
            ['2', 'two'],
            ['3', 'three'],
            ['4', 'four'],
            ['5', 'five'],
            ['6', 'six'],
            ['7', 'seven'],
            ['8', 'eight'],
            ['9', 'nine'],
        ];
    }

    /**
     * @return array
     */
    public function getTensProvider()
    {
        return [
            ['10', 'ten'],
            ['11', 'eleven'],
            ['12', 'twelve'],
            ['13', 'thirteen'],
            ['14', 'fourteen'],
            ['15', 'fifteen'],
            ['16', 'sixteen'],
            ['17', 'seventeen'],
            ['18', 'eighteen'],
            ['19', 'nineteen'],
        ];
    }

    /**
     * @return array
     */
    public function getTwentysProvider()
    {
        return [
            ['20', 'twenty'],
            ['21', 'twenty-one'],
            ['22', 'twenty-two'],
            ['23', 'twenty-three'],
            ['24', 'twenty-four'],
            ['25', 'twenty-five'],
            ['26', 'twenty-six'],
            ['27', 'twenty-seven'],
            ['28', 'twenty-eight'],
            ['29', 'twenty-nine'],
        ];
    }

    /**
     * @return array
     */
    public function getHundredsProvider()
    {
        return [
            ['100', 'one hundred'],
            ['101', 'one hundred one'],
            ['110', 'one hundred ten'],
            ['111', 'one hundred eleven'],
            ['116', 'one hundred sixteen'],
            ['133', 'one hundred thirty-three'],
            ['160', 'one hundred sixty'],
            ['190', 'one hundred ninety'],
            ['199', 'one hundred ninety-nine'],
            ['300', 'three hundred'],
            ['699', 'six hundred ninety-nine'],
        ];
    }

    /**
     * @return array
     */
    public function getNegativeAndPlusProvider()
    {
        return [
            ['+1', 'one'],
            ['-1', 'minus one'],
            ['+42', 'forty-two'],
            ['-42', 'minus forty-two'],
            ['-699', 'minus six hundred ninety-nine'],
            ['-999', 'minus nine hundred ninety-nine'],
        ];
    }

    /**
     * @return array
     */
    public function getThousandsProvider()
    {
        return [
            ['1000', 'one thousand'],
            ['1001', 'one thousand one'],
            ['1999', 'one thousand nine hundred ninety-nine'],
            ['1100', 'one thousand one hundred'],
            ['1016', 'one thousand sixteen'],
            ['4392', 'four thousand three hundred ninety-two'],
            ['1584', 'one thousand five hundred eighty-four'],
            ['5023', 'five thousand twenty-three'],
            ['9433', 'nine thousand four hundred thirty-three']
        ];
    }

    /**
     * @return array
     */
    public function getMillionsProvider()
    {
        return [
            ['1000000', 'one million'],
            ['1000000000', 'one billion'],
            ['1000000000000', 'one trillion'],
            ['4000000000000000005002388', 'four septillion five million two thousand three hundred eighty-eight'],
            ['1' . str_repeat('0', 3003), 'one millinillion'],
            ['6' . str_repeat('0', 1800), 'six novenonagintaquingentillion'],
            ['6' . str_repeat('0', 312), 'six trescentillion'],
            ['1' . str_repeat('0', 3000003), 'one millinillinillion'],
            ['1' . str_repeat('0', 462), 'one tresquinquagintacentillion'],
            ['1' . str_repeat('0', 138), 'one quinquaquadragintillion'],
            ['1' . str_repeat('0', 516), 'one unseptuagintacentillion'],
            ['1' . str_repeat('0', 612), 'one treducentillion'],
            ['1' . str_repeat('0', 654), 'one septendeciducentillion'],
            ['1' . str_repeat('0', 4854), 'one millimilliquinquasexagintaquadringentillion'],
            ['1' . str_repeat('0', 828), 'one quinquaseptuagintaducentillion'],
            ['1' . str_repeat('0', 2418), 'one quinquaoctingentillion'],
            ['1' . str_repeat('0', 4836), 'one millimilliunquadragintaquadringentillion'],
            ['899' . str_repeat('0', 498), 'eight hundred ninety-nine quinquasexagintacentillion'],
        ];
    }

    /**
     * @return array
     */
    public function getFloatingPointNumbersProvider()
    {
        return [
            ['0.50', 'zero point five'],
            ['-101.88', 'minus one hundred one point eight eight'],
            ['39279.43000', 'thirty-nine thousand two hundred seventy-nine point four three']
        ];
    }

    /**
     * @return array
     */
    public function largeNumberProvider()
    {
        return [
            [3003, 'millinillion'],
            [303, 'centillion'],
            [6, 'million'],
            [9, 'billion'],
            [183, 'sexagintillion'],
            [336, 'undecicentillion'],
        ];
    }
}