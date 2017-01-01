# number-to-words
[![Build Status](https://travis-ci.org/patrickschur/number-to-words.svg?branch=master)](https://travis-ci.org/patrickschur/number-to-words)
[![codecov](https://codecov.io/gh/patrickschur/number-to-words/branch/master/graph/badge.svg)](https://codecov.io/gh/patrickschur/number-to-words)
[![Version](https://img.shields.io/packagist/v/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Total Downloads](https://img.shields.io/packagist/dt/patrickschur/number-to-words.svg?style=flat-square)](https://packagist.org/packages/patrickschur/number-to-words)
[![Maintenance](https://img.shields.io/maintenance/yes/2017.svg?style=flat-square)](https://github.com/patrickschur/number-to-words)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-FF.svg?style=flat-square)](http://php.net/)
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
 
echo $n->convert('1' . str_repeat('0', 6000)); // outputs "eine Millinillion"
echo $n->convert('140,29'); // outputs "einhundertvierzig Komma zwei neun"
echo $n->convert('40932'); // outputs "vierzigtausendneunhundertzweiunddreißig"
```