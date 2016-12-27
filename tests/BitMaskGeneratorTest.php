<?php

namespace Jelle_S\Test\Util\BitMask;

use PHPUnit\Framework\TestCase;
use Jelle_S\Util\BitMask\BitMaskGenerator;

/**
 * Tests \Jelle_S\Util\BitMask\BitMaskGenerator.
 *
 * @author Jelle Sebreghts
 */
class BitMaskGeneratorTest extends TestCase {

  /**
   * The bitmask generator
   * @var \Jelle_S\Util\BitMask\BitMaskGenerator
   */
  protected $generator;

  protected $length;

  protected $minPositives;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $length_range = range(4, 8);
    $this->length = $length_range[array_rand($length_range)];
    $min_positives_range = range(1, $this->length - 1);
    $this->minPositives = $min_positives_range[array_rand($min_positives_range)];
    $this->generator = new BitMaskGenerator($this->length, $this->minPositives);
  }

  protected function getNumberOfPossibleMasks() {
    $mask_count = 0;
    for ($i = $this->minPositives; $i <= $this->length; $i++) {
      $mask_count += $this->factorial($this->length)/($this->factorial($i) * $this->factorial($this->length - $i));
    }
    return $mask_count;
  }

  protected function factorial($number) {
    $f = 1;
    for ($i = $number; $i>= 1; $i--) {
      $f *= $i;
    }
    return $f;
  }

  /**
   * Test getNextMask().
   */
  public function testGetNextMask() {
    $found_combinations = 0;
    while ($mask = $this->generator->getNextMask()) {
      $mask_arr = str_split($mask);
      // Assert masks only contain 1's and 0's.
      $this->assertEmpty(array_diff($mask_arr, array('0', '1')));
      // Assert the length.
      $this->assertCount($this->length, $mask_arr);
      // Assert the number of positives.
      $this->assertGreaterThanOrEqual($this->minPositives, count(array_filter($mask_arr)));
      $found_combinations++;
    }
    $this->assertEquals($found_combinations, $this->getNumberOfPossibleMasks());

  }
}
