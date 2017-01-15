# number-to-words
[![Build Status](https://travis-ci.org/patrickschur/number-to-words.svg?branch=master)](https://travis-ci.org/patrickschur/number-to-words)
[![codecov](https://codecov.io/gh/patrickschur/number-to-words/branch/master/graph/badge.svg)](https://codecov.io/gh/patrickschur/number-to-words)
[![Version](https://img.shields.io/packagist/v/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Total Downloads](https://img.shields.io/packagist/dt/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg?style=flat-square)](https://github.com/patrickschur/number-to-words)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-FF.svg?style=flat-square)](http://php.net/)
[![License](https://img.shields.io/packagist/l/patrickschur/number-to-words.svg?style=flat-square)](https://opensource.org/licenses/MIT)

Convert numbers to words in English or German.

Install via Composer
-
```bash
$ composer require patrickschur/number-to-words
```

How to use
-
English
-
```php
use NumberToWords\NumberToWords;
use NumberToWords\Locale\English;
 
$c = new NumberToWords(new English()); // english
 
// One followed by 3003 zeros
echo $c->nameOfLargeNumber(3003); // outputs "millinillion"
 
echo $n->convert('3043.43'); // outputs "three thousand forty-three point four three"
echo $n->convert('3.1415926535'); // outputs "three point one four one five nine two six five three five"
```

German
-
```php
use NumberToWords\NumberToWords;
use NumberToWords\Locale\German;
 
$c = new NumberToWords(new German()); // german
 
// Eine Eins gefolgt von 6000 Nullen
echo $c->nameOfLargeNumber(6000); // outputs "Millinillion"
 
// Eine Eins gefolgt von 59994 Nullen
echo $c->nameOfLargeNumber(59994); // outputs "Nonillinovenonagintanongentillion"
 
echo $n->convert('509324'); // outputs "fünfhundertneuntausenddreihundertvierundzwanzig"
echo $n->convert('3,1415926535'); // outputs "drei Komma eins vier eins fünf neun zwei sechs fünf drei fünf"
```