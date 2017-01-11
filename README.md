# BitMaskGenerator

[![Build Status](https://travis-ci.org/Jelle-S/bitmaskgenerator.svg?branch=develop)](https://travis-ci.org/Jelle-S/bitmaskgenerator) [![Code Climate](https://codeclimate.com/github/Jelle-S/bitmaskgenerator/badges/gpa.svg)](https://codeclimate.com/github/Jelle-S/bitmaskgenerator) [![Test Coverage](https://codeclimate.com/github/Jelle-S/bitmaskgenerator/badges/coverage.svg)](https://codeclimate.com/github/Jelle-S/bitmaskgenerator/coverage) [![Issue Count](https://codeclimate.com/github/Jelle-S/bitmaskgenerator/badges/issue_count.svg)](https://codeclimate.com/github/Jelle-S/bitmaskgenerator)

Usage:
```php
use Jelle_S\Util\BitMask\BitMaskGenerator;
$length = 5;
$minPositives = 2;
// BitMaskGenerator that generates bitmasks with a length of 5 and at least two
// positives (1's).
$generator = new BitMaskGenerator($length, $minPositives);
while ($mask = $generator->getNextMask()) {
  print $mask . "\n";
}
```

Output:
```
00011
00101
00110
01001
01010
01100
10001
10010
10100
11000
00111
01011
01101
01110
10011
10101
10110
11001
11010
11100
01111
10111
11011
11101
11110
11111
```
