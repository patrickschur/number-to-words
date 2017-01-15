<?php

declare(strict_types = 1);

namespace NumberToWords\Locale;

/**
 * Class German
 *
 * @author Patrick Schur <patrick_schur@outlook.de>
 * @package Locale
 */
class English implements LocaleInterface
{
    private const UNITS = [
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine'
    ];

    private const PRE_NON_UNITS = [
        1 => 'mi',
        'bi',
        'tri',
        'quadri',
        'quinti',
        'sexti',
        'septi',
        'octi',
        'noni'
    ];

    private const PRE_UNITS = [
        1 => 'un',
        'duo',
        'tre',
        'quattuor',
        'quinqua',
        'se',
        'septe',
        'octo',
        'nove'
    ];

    private const PRE_TENS = [
        1 => 'deci',
        'viginti',
        'triginta',
        'quadraginta',
        'quinquaginta',
        'sexaginta',
        'septuaginta',
        'octoginta',
        'nonaginta'
    ];

    private const PRE_HUNDREDS = [
        1 => 'centi',
        'ducenti',
        'trecenti',
        'quadringenti',
        'quingenti',
        'sescenti',
        'septingenti',
        'octingenti',
        'nongenti'
    ];

    /**
     * @param string $number
     * @return null|string
     */
    public function convert(string $number): ?string
    {
        if (!preg_match('/^([+-]?([1-9]\d*(\.\d+)?|0\.\d+)|0)$/', $number))
        {
            return null;
        }

        $words = '';

        switch ($number[0])
        {
            /** @noinspection PhpMissingBreakStatementInspection */
            case '-':
                $words .= 'minus';
            case '+':
                $number = substr($number, 1);
        }

        $fraction = false;
        $triplet = [];

        if (strpos($number, '.'))
        {
            $number = rtrim($number, '0');
            list($number, $fraction) = explode('.', $number);
        }

        for ($i = -3, $length = strlen($number); $length > 3; $i -= 3, $length -= 3)
        {
            $triplet[] = substr($number, $i, 3);
        }

        $triplet[] = substr($number, 0, $length);

        for ($i = count($triplet) - 1; $i >= 0; $i--)
        {
            $power = $i * 3;

            $hundreds = $triplet[$i][-3] ?? 0;
            $tens = $triplet[$i][-2] ?? 0;
            $units = $triplet[$i][-1] ?? 0;

            if (!($hundreds + $tens + $units))
            {
                if (0 == $power && !isset($triplet[1]))
                {
                    $words .= self::UNITS[0];
                }
                continue;
            }

            if ($hundreds) {
                $words .= ' '. self::UNITS[$hundreds] . ' hundred';
            }

            /*
                if ($hundreds && ($tens || $units))
                {
                    $words .= ' and ';
                }
            //*/

            switch ($tens)
            {
                case 9:
                    $words .= ' ninety';
                    break;
                case 8:
                    $words .= ' eighty';
                    break;
                case 5:
                    $words .= ' fifty';
                    break;
                case 4:
                    $words .= ' forty';
                    break;
                case 7:
                    $words .= ' seventy';
                    break;
                case 6:
                    $words .= ' sixty';
                    break;
                case 3:
                    $words .= ' thirty';
                    break;
                case 2:
                    $words .= ' twenty';
                    break;
                case 1:
                    switch ($units)
                    {
                        case 9:
                            $words .= ' nineteen';
                            break;
                        case 8:
                            $words .= ' eighteen';
                            break;
                        case 7:
                            $words .= ' seventeen';
                            break;
                        case 6:
                            $words .= ' sixteen';
                            break;
                        case 5:
                            $words .= ' fifteen';
                            break;
                        case 4:
                            $words .= ' fourteen';
                            break;
                        case 3:
                            $words .= ' thirteen';
                            break;
                        case 2:
                            $words .= ' twelve';
                            break;
                        case 1:
                            $words .= ' eleven';
                            break;
                        case 0:
                            $words .= ' ten';
                            break;
                    }
            }

            if ($tens > 1 && $units > 0)
            {
                $words .= '-'. self::UNITS[$units];
            }
            else if ($tens == 0 && $units > 0)
            {
                $words .= ' '. self::UNITS[$units];
            }

            switch ($power)
            {
                case 0:
                    break 2;
                case 3:
                    $words .= ' thousand';
                    break;
                default:
                    $words .= ' ' . $this->helper($power);
            }
        }

        $words = rtrim($words);

        if ($fraction != false)
        {
            $words .= ' point';

            foreach (str_split($fraction) as $digit)
            {
                $words .= ' '. self::UNITS[$digit];
            }
        }

        return trim($words);
    }

    /**
     * @param int $exponent
     * @throws \LengthException if exponent is less than 6
     * @return mixed
     */
    public function nameOfLargeNumber(int $exponent)
    {
        if ($exponent < 6)
        {
            throw new \LengthException('Power must be greater than or equal to 6.');
        }

        return $this->helper($exponent);
    }

    /**
     * @param int $power
     * @param bool $recursive
     * @return string
     */
    private function helper(int $power, bool $recursive = false)
    {
        $words = '';
        $exp = intdiv(($power - 3), 3);

        if ($exp < 10)
        {
            $words .= self::PRE_NON_UNITS[$exp];
        }
        else if ($exp < 1000)
        {
            $tens = $exp / 10 % 10;
            $units = $exp % 10;

            if ($units > 0)
            {
                $words .= self::PRE_UNITS[$units];

                if ($units == 9 || $units == 7)
                {
                    if ($tens == 1 || $tens == 3 || $tens == 4 || $tens == 5 || $tens == 6 || $tens == 7)
                    {
                        $words .= 'n';
                    }
                    else if ($tens == 2 || $tens == 8)
                    {
                        $words .= 'm';
                    }
                }
                else if ($units == 3 || $units == 6)
                {
                    if ($units == 6 && $tens == 8)
                    {
                        $words .= 'x';
                    }
                    else if ($tens == 2 || $tens == 3 || $tens == 4 || $tens == 5 || $tens == 8)
                    {
                        $words .= 's';
                    }
                }
            }

            if ($tens > 0)
            {
                $words .= self::PRE_TENS[$tens];
            }

            if ($exp >= 100)
            {
                $hundreds = $exp / 100 % 10;

                if ($tens == 0)
                {
                    if ($units == 9 || $units == 7)
                    {
                        if ($hundreds == 1 || $hundreds == 2 || $hundreds == 3 || $hundreds == 4 || $hundreds == 5 || $hundreds == 6 || $hundreds == 7)
                        {
                            $words .= 'n';
                        }
                        else if ($hundreds == 8)
                        {
                            $words .= 'm';
                        }
                    }
                    else if ($units == 3 || $units == 6)
                    {
                        if ($units == 6 && ($hundreds == 1 || $hundreds == 8))
                        {
                            $words .= 'x';
                        }
                        else if ($hundreds == 1 || $hundreds == 3 || $hundreds == 4 || $hundreds == 5 || $hundreds == 8)
                        {
                            $words .= 's';
                        }
                    }
                }

                $words .= self::PRE_HUNDREDS[$hundreds];
            }
        }
        else
        {
            $v = [];

            $exp = (string)$exp;

            for ($i = -3, $l = strlen($exp); $l > 3; $i -= 3, $l -= 3)
            {
                $v[] = substr($exp, $i, 3);
            }

            $v[] = substr($exp, 0, $l);

            for ($i = count($v) - 1; $i >= 0; $i--)
            {
                if ($v[$i] + 0 == 0)
                {
                    $words .= 'ni';

                    if ($i * 3 != 0)
                    {
                        $words .= 'lli';
                    }
                    continue;
                }

                $words .= $this->helper($v[$i] * 6, true);

                if ($i * 3 != 0)
                {
                    $words .= 'lli';
                }
            }
        }

        if ($recursive)
        {
            return $words;
        }

        $words = substr_replace($words, 'i', -1);

        return $words . 'llion';
    }
}