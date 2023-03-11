<?php declare(strict_types=1);

namespace Y0x54a\Nik;

use DateTimeInterface;

interface NikInterface extends StringableInterface
{
  /**
   * @return string
   */
  public function getRaw(): string;

  /**
   * @return int
   */
  public function getProvince(): int;

  /**
   * @return string
   */
  public function getRawProvince(): string;

  /**
   * @return int
   */
  public function getRegency(): int;

  /**
   * @return string
   */
  public function getRawRegency(): string;

  /**
   * @return int
   */
  public function getDistrict(): int;

  /**
   * @return string
   */
  public function getRawDistrict(): string;

  /**
   * @return DateTimeInterface
   */
  public function getDob(): DateTimeInterface;

  /**
   * @return string
   */
  public function getRawDob(): string;

  /**
   * @return int
   */
  public function getDobDay(): int;

  /**
   * @return string
   */
  public function getRawDobDay(): string;

  /**
   * @return int
   */
  public function getDobMonth(): int;

  /**
   * @return string
   */
  public function getRawDobMonth(): string;

  /**
   * @return int
   */
  public function getDobYear(): int;

  /**
   * @return string
   */
  public function getRawDobYear(): string;

  /**
   * @return int
   */
  public function getSequence(): int;

  /**
   * @return string
   */
  public function getRawSequence(): string;

  /**
   * @return bool
   */
  public function isFemale(): bool;
}