<?php

namespace Jelle_S\Util\BitMask;

use Jelle_S\Util\Permutation\LexographicalPermutation;

/**
 * Generates all possible bitmasks with a minimum amount of positives (1's) and
 * a certain length.
 *
 * @author Jelle Sebreghts
 */
class BitMaskGenerator {

  /**
   * The currently generated mask.
   *
   * @var array
   */
  protected $mask;

  /**
   * The length the generated masks should be.
   *
   * @var int
   */
  protected $length;

  /**
   * The minimum amount of positives (1's) the generated masks should have.
   *
   * @var int
   */
  protected $minPositives;

  /**
   * The amount of positives (1's) the current mask has.
   *
   * @var int
   */
  protected $positivesAmount;

  /**
   * Creates a new MaskGenerator.
   *
   * @param int $length
   *   The length the generated masks should be.
   * @param int $minPositives
   *   The minimum amount of positives (1's) the generated masks should have.
   */
  public function __construct($length, $minPositives) {
    $this->length = $length;
    $this->minPositives = $this->positivesAmount = $minPositives;
  }

  /**
   * Returns the next mask.
   *
   * @return string|boolean
   *   The next mask if there is a next one, FALSE if all possible masks have
   *   already been generated.
   */
  public function getNextMask() {
    return $this->generateNextMask() ? implode('', $this->mask) : FALSE;
  }

  /**
   * Generates the next mask.
   *
   * @return boolean
   *   TRUE on success, FALSE on failure (= there is no next mask left to be
   *   generated).
   */
  protected function generateNextMask() {
    if (is_null($this->mask)) {
      $this->generateFirstMask();
      return TRUE;
    }
    if (!$this->generateNextPermutation()) {
      return $this->addPositive();
    }
    return TRUE;
  }

  /**
   * Generates the next permutation of the current mask.
   *
   * @return boolean
   *   TRUE on success, FALSE on failure (= there is no next permutation of the
   *   current mask).
   */
  protected function generateNextPermutation() {
    $number = implode('', $this->mask);
    $result = LexographicalPermutation::getNextPermutation($number);
    if ($result !== FALSE) {
      $this->mask = str_split($result);
    }
    return $result !== FALSE;
  }

  /**
   * Generates the very first mask.
   */
  protected function generateFirstMask() {
    $this->mask = array_fill(0, $this->length, 0);
    for ($i = 0; $i < $this->positivesAmount; $i++) {
      $this->mask[$this->length - $i - 1] = 1;
    }
  }

  /**
   * Adds a positive marker to the mask.
   *
   * @return boolean
   *   TRUE on success, FALSE on failure (= all markers are already positive).
   */
  protected function addPositive() {
    if ($this->positivesAmount >= $this->length) {
      return FALSE;
    }
    $this->positivesAmount++;
    $this->generateFirstMask();
    return TRUE;
  }

}
