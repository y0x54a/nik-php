<?php declare(strict_types=1);

namespace Y0x54a\Nik;

use Throwable;
use DateTime;
use DateTimeZone;
use DateTimeInterface;
use InvalidArgumentException;

class Nik implements NikInterface
{
  /**
   * @var string
   */
  protected const REGEXP = '/^((?:0[1-9]|[1-9][0-9]))((?:0[1-9]|[1-9][0-9]))((?:0[1-9]|[1-9][0-9]))((?:0[1-9]|[1-9][0-9]))((?:0[1-9]|[1-9][0-9]))((?:[0-9]{2}))((?:[0-9]{2})(?:0[1-9]|[1-9][0-9]))$/';

  /**
   * @var string
   */
  protected $raw;

  /**
   * @var int
   */
  protected $province;

  /**
   * @var string
   */
  protected $rawProvince;

  /**
   * @var int
   */
  protected $regency;

  /**
   * @var string
   */
  protected $rawRegency;

  /**
   * @var int
   */
  protected $district;

  /**
   * @var string
   */
  protected $rawDistrict;

  /**
   * @var int
   */
  protected $dobDay;

  /**
   * @var string
   */
  protected $rawDobDay;

  /**
   * @var int
   */
  protected $dobMonth;

  /**
   * @var string
   */
  protected $rawDobMonth;

  /**
   * @var int
   */
  protected $dobYear;

  /**
   * @var string
   */
  protected $rawDobYear;

  /**
   * @var int
   */
  protected $sequence;

  /**
   * @var string
   */
  protected $rawSequence;

  /**
   * @param string|NikInterface $raw
   */
  public function __construct($raw){
    if ($raw instanceof NikInterface) {
      $raw = $raw->getRaw();
    }
    $this->parseRaw($raw);
  }

  /**
   * @return string
   */
  public function getRaw(): string{
    return $this->raw;
  }

  /**
   * @return int
   */
  public function getProvince(): int{
    return $this->province;
  }
  
  /**
   * @return string
   */
  public function getRawProvince(): string{
    return $this->rawProvince;
  }

  /**
   * @return int
   */
  public function getRegency(): int{
    return $this->regency;
  }

  /**
   * @return string
   */
  public function getRawRegency(): string{
    return $this->rawRegency;
  }

  /**
   * @return int
   */
  public function getDistrict(): int{
    return $this->district;
  }

  /**
   * @return string
   */
  public function getRawDistrict(): string{
    return $this->rawDistrict;
  }

  /**
   * @return DateTimeInterface
   */
  public function getDob(): DateTimeInterface{
    return $this->createDobDate($this->dobYear, $this->dobMonth, $this->dobDay);
  }

  /**
   * @return string
   */
  public function getRawDob(): string{
    return $this->rawDobDay . $this->rawDobMonth . $this->rawDobYear;
  }

  /**
   * @return int
   */
  public function getDobDay(): int{
    return $this->dobDay;
  }

  /**
   * @return string
   */
  public function getRawDobDay(): string{
    return $this->rawDobDay;
  }

  /**
   * @return int
   */
  public function getDobMonth(): int{
    return $this->dobMonth;
  }

  /**
   * @return string
   */
  public function getRawDobMonth(): string{
    return $this->rawDobMonth;
  }

  /**
   * @return int
   */
  public function getDobYear(): int{
    return $this->dobYear;
  }

  /**
   * @return string
   */
  public function getRawDobYear(): string{
    return $this->rawDobYear;
  }

  /**
   * @return int
   */
  public function getSequence(): int{
    return $this->sequence;
  }

  /**
   * @return string
   */
  public function getRawSequence(): string{
    return $this->rawSequence;
  }

  /**
   * @return bool
   */
  public function isFemale(): bool{
    return $this->dobDay > 40;
  }

  /**
   * @return string
   */
  public function __toString(): string{
    return $this->raw;
  }

  /**
   * @param string $raw
   * @throws InvalidArgumentException
   * @return NikInterface
   */
  protected function parseRaw(string $raw): NikInterface{
    $match = [];
    if (!preg_match(static::REGEXP, $raw, $match)) {
      throw new InvalidArgumentException('Invalid NIK');
    }
    $this->raw = $match[0];
    $this->province = (int)$match[1];
    $this->rawProvince = $match[1];
    $this->regency = (int)$match[2];
    $this->rawRegency = $match[2];
    $this->district = (int)$match[3];
    $this->rawDistrict = $match[3];
    $this->dobDay = (int)$match[4];
    $this->rawDobDay = $match[4];
    $this->dobMonth = (int)$match[5];
    $this->rawDobMonth = $match[5];
    $this->dobYear = (int)$match[6];
    $this->rawDobYear = $match[6];
    $this->sequence = (int)$match[7];
    $this->rawSequence = $match[7];
    return $this;
  }

  /**
   * @param string $date
   * @return DateTimeInterface
   */
  protected function parseDate(string $date): DateTimeInterface{
    return new DateTime($date, new DateTimeZone('UTC'));
  }

  /**
   * @param int $year
   * @param int $month
   * @param int $day
   * @throws InvalidArgumentException
   * @return DateTimeInterface
   */
  protected function createDobDate(int $year, int $month, int $day): DateTimeInterface{
    $day = $day > 40 ? $day - 40 : $day;
    $year = $this->createDobYear($year, $month, $day);
    $value = sprintf('%04d-%02d-%02d', $year, $month, $day);
    try {
      $date = $this->parseDate($value);
    } catch (Throwable $e) {
      throw new InvalidArgumentException('Invalid NIK (date of birth)');
    }
    if ($date->format('Y-m-d') !== $value) {
      throw new InvalidArgumentException('Invalid NIK (date of birth)');
    }
    return $date;
  }

  /**
   * @param int $year
   * @param int $month
   * @param int $day
   * @return int
   */
  protected function createDobYear(int $year, int $month, int $day): int{
    $now = $this->parseDate('now');
    $nowYear = (int)$now->format('Y') % 10000;
    $newYear = (int)floor($nowYear / 100) * 100 + $year;
    if ($newYear < $nowYear) {
      return $newYear;
    }
    $offset = $newYear < 100 ? -9900 : 100;
    if ($newYear > $nowYear) {
      return $newYear - $offset;
    }
    $nowMonth = (int)$now->format('n');
    if ($month < $nowMonth) {
      return $newYear;
    }
    if ($month > $nowMonth) {
      return $newYear - $offset;
    }
    $nowDay = (int)$now->format('j');
    if ($day > $nowDay) {
      return $newYear - $offset;
    }
    return $newYear;
  }
}