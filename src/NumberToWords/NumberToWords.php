<?php

declare(strict_types = 1);

namespace NumberToWords;

/**
 * Class NumberToWords
 *
 * @author Patrick Schur <patrick_schur@outlook.de>
 * @package NumberToWords
 */
class NumberToWords
{
    private const UNITS = [
        'null',
        'ein',
        'zwei',
        'drei',
        'vier',
        'fünf',
        'sechs',
        'sieben',
        'acht',
        'neun'
    ];

    private const PRE_NON_UNITS = [
        1 => 'mi',
        'bi',
        'tri',
        'quadri',
        'quinti',
        'sexti',
        'septi',
        'okti',
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
        'okto',
        'nove'
    ];

    private const PRE_TENS = [
        1 => 'dezi',		
        'viginti',		
        'triginta',		
        'quadraginta',		
        'quinquaginta',		
        'sexaginta',		
        'septuaginta',		
        'oktoginta',		
        'nonaginta'
    ];
    
    private const PRE_HUNDREDS = [
        1 => 'zenti',
        'duzenti',
        'trezenti',
        'quadringenti',
        'quingenti',
        'seszenti',
        'septingenti',
        'oktingenti',
        'nongenti'
    ];

    /**
     * Convert numbers to words in German
     *
     * @param string $number
     * @return null|string
     */
    public function convert(string $number): ?string
    {
       // if (!preg_match('/^([+-]?([1-9]\d*(,\d+)?|0,\d+)|0)$/', $number))
        {
         //   return null;
        }

        $words = '';

        switch ($number[0])
        {
            /** @noinspection PhpMissingBreakStatementInspection */
            case '-':
                $words .= 'minus ';
            case '+':
                $number = substr($number, 1);
        }

        $fraction = false;
        $triplet = [];

        if (strpos($number, ','))
        {
            $number = rtrim($number, '0');
            list($number, $fraction) = explode(',', $number);
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
                $words .= self::UNITS[$hundreds] . 'hundert';
            }

            if ($tens != 1 && $units > 0)
            {
                if ($tens > 0)
                {
                    $words .= self::UNITS[$units] . 'und';
                }
                else
                {
                    $words .= self::UNITS[$units];

                    if ($units < 2 && $power == 0)
                    {
                        $words .= 's';
                    }
                    else if ($units < 2 && $power != 3 && $triplet[$i] != 101)
                    {
                        $words .= 'e';
                    }
                }
            }

            switch ($tens)
            {
                case 9:
                case 8:
                case 5:
                case 4:
                    $words .= self::UNITS[$tens] . 'zig';
                    break;
                case 7:
                    $words .= 'siebzig';
                    break;
                case 6:
                    $words .= 'sechzig';
                    break;
                case 3:
                    $words .= 'dreißig';
                    break;
                case 2:
                    $words .= 'zwanzig';
                    break;
                case 1:
                    switch ($units)
                    {
                        case 3:
                        case 4:
                        case 5:
                        case 8:
                        case 9:
                            $words .= self::UNITS[$units] . 'zehn';
                            break;
                        case 0:
                            $words .= 'zehn';
                            break;
                        case 1:
                            $words .= 'elf';
                            break;
                        case 2:
                            $words .= 'zwölf';
                            break;
                        case 6:
                            $words .= 'sechzehn';
                            break;
                        case 7:
                            $words .= 'siebzehn';
                    }
            }

            $x = (1 == $units && !($tens + $hundreds)) ? 0 : 1;

            switch ($power)
            {
                case 0:
                    break 2;
                case 3:
                    $words .= 'tausend';
                    break;
                default:
                    $words .= ' ' . $this->helper($power)[$x] . ' ';
            }
        }

        $words = rtrim($words);

        if ($fraction != false)
        {
            $words .= ' Komma ';

            foreach (str_split($fraction) as $digit)
            {
                $words .= ((1 == $digit) ? 'eins' : self::UNITS[$digit]) . ' ';
            }
        }

        return trim($words);
    }

    /**
     * @param $power
     * @param bool $r
     * @return array|string
     */
    private function helper($power, $r = false)
    {
        $words = '';
        $exp = intdiv($power, 6);

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
                    if ($tens == 2 || $tens == 3 || $tens == 4 || $tens == 5)
                    {
                        $words .= 's';
                    }

                    if ($units == 6 && $tens == 8)
                    {
                        $words .= 'x';
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
                        if ($hundreds == 3 || $hundreds == 4 || $hundreds == 5)
                        {
                            $words .= 's';
                        }

                        if ($units == 6 && ($hundreds == 1 || $hundreds == 8))
                        {
                            $words .= 'x';
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

        if ($r)
        {
            return $words;
        }

        $words = ucfirst($words);
        $words = substr_replace($words, 'i', -1);

        $power = (string)(floor($power / 6 * 2) / 2);

        if (strpos($power, '.'))
        {
            return [$words . 'lliarde', $words . 'lliarden'];
        }

        return [$words . 'llion', $words . 'llionen'];
    }
}