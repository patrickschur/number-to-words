# number-to-words
[![Build Status](https://travis-ci.org/patrickschur/number-to-words.svg?branch=master)](https://travis-ci.org/patrickschur/number-to-words)
[![codecov](https://codecov.io/gh/patrickschur/number-to-words/branch/master/graph/badge.svg)](https://codecov.io/gh/patrickschur/number-to-words)
[![Version](https://img.shields.io/packagist/v/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Total Downloads](https://img.shields.io/packagist/dt/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg?style=flat-square)](https://github.com/patrickschur/number-to-words)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-FF.svg?style=flat-square)](http://php.net/)
[![License](https://img.shields.io/packagist/l/patrickschur/number-to-words.svg?style=flat-square)](https://opensource.org/licenses/MIT)

Convert numbers to words in German.

Install via Composer
-
```bash
$ composer require patrickschur/number-to-words
```

Basic Usage
-
```php
use NumberToWords\NumberToWords;
 
$n = new NumberToWords;
 
echo $n->nameOfLargeNumber(6000); // outputs "Millinillion"
echo $n->nameOfLargeNumber(1000); // outputs "Sesexagintazentilliarde"
 
echo $n->convert('210004001'); // outputs "zweihundertzehn Millionen viertausendeins"
echo $n->convert('3,1415926'); // outputs "drei Komma eins vier eins fünf neun zwei sechs"
```