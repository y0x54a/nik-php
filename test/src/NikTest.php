<?php declare(strict_types=1);

namespace Y0x54aTest\Nik;

use Throwable;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Y0x54a\Nik\Nik;

class NikWrapper extends Nik
{
  protected $year;
  protected $month;
  protected $day;

  public function __construct($raw, int $year = 50, int $month = 6, int $day = 15){
    parent::__construct($raw);
    $this->year = $year;
    $this->month = $month;
    $this->day = $day;
  }

  protected function parseDate(string $date): DateTimeInterface{
    return $date === 'now' ? new DateWrapper($this->year, $this->month, $this->day) : parent::parseDate($date);
  }
}

class DateWrapper extends DateTime
{
  protected $year;
  protected $month;
  protected $day;

  public function __construct(int $year = 50, int $month = 6, int $day = 15){
    $this->year = sprintf('%04d', $year);
    $this->month = (string)$month;
    $this->day = (string)$day;
  }

  public function format($format): string{
    switch ($format){
      case 'Y':
        return $this->year;
      case 'n':
        return $this->month;
      case 'j':
        return $this->day;
    }
    return parent::format($format);
  }
}

class NikTest extends TestCase
{
  protected $resources;

  protected function setUp(): void{
    $this->resources = require(__DIR__.'/resources.php');
  }

  public function testMale(){
    $nik = new NikWrapper('0102030405060001', 1234, 12, 31);
    $this->assertEquals($nik->isFemale(), false);
    $this->assertEquals($nik->getDob()->format('Y-m-d'), '1206-05-04');
  }

  public function testFemale(){
    $nik = new NikWrapper('0102034405060001', 1234, 12, 31);
    $this->assertEquals($nik->isFemale(), true);
    $this->assertEquals($nik->getDob()->format('Y-m-d'), '1206-05-04');
  }

  public function testValidInputs(){
    foreach ($this->resources['validInputs'] as $input){
      $nik = new NikWrapper($input[0]);
      $this->assertEquals($nik->getRaw(), $input[0]);
      $this->assertEquals($nik->getProvince(), $input[1]);
      $this->assertEquals($nik->getRawProvince(), sprintf('%02d', $input[1]));
      $this->assertEquals($nik->getRegency(), $input[2]);
      $this->assertEquals($nik->getRawRegency(), sprintf('%02d', $input[2]));
      $this->assertEquals($nik->getDistrict(), $input[3]);
      $this->assertEquals($nik->getRawDistrict(), sprintf('%02d', $input[3]));

      $dob = $nik->getDob();
      $this->assertInstanceOf(DateTimeInterface::class, $dob);
      $this->assertEquals($dob->format('Y-m-d'), $input[4]);
      $this->assertEquals($nik->getRawDob(), $input[5]);
      $this->assertEquals($nik->getDobDay(), $input[6]);
      $this->assertEquals($nik->getRawDobDay(), sprintf('%02d', $input[6]));
      $this->assertEquals($nik->getDobMonth(), $input[7]);
      $this->assertEquals($nik->getRawDobMonth(), sprintf('%02d', $input[7]));
      $this->assertEquals($nik->getDobYear(), $input[8]);
      $this->assertEquals($nik->getRawDobYear(), sprintf('%02d', $input[8]));

      $this->assertEquals($nik->getSequence(), $input[9]);
      $this->assertEquals($nik->getRawSequence(), sprintf('%04d', $input[9]));
      $this->assertEquals($nik->isFemale(), $input[10]);
      $this->assertEquals($nik->__toString(), $input[0]);

      $newNik = new NikWrapper($nik);
      $this->assertEquals($newNik->getRaw(), $nik->getRaw());
      $this->assertEquals($newNik->getProvince(), $nik->getProvince());
      $this->assertEquals($newNik->getRawProvince(), $nik->getRawProvince());
      $this->assertEquals($newNik->getRegency(), $nik->getRegency());
      $this->assertEquals($newNik->getRawRegency(), $nik->getRawRegency());
      $this->assertEquals($newNik->getDistrict(), $nik->getDistrict());
      $this->assertEquals($newNik->getRawDistrict(), $nik->getRawDistrict());

      $newDob = $newNik->getDob();
      $this->assertInstanceOf(DateTimeInterface::class, $newDob);
      $this->assertEquals($newDob->format('Y-m-d'), $dob->format('Y-m-d'));
      $this->assertEquals($newNik->getRawDob(), $nik->getRawDob());
      $this->assertEquals($newNik->getDobDay(), $nik->getDobDay());
      $this->assertEquals($newNik->getRawDobDay(), $nik->getRawDobDay());
      $this->assertEquals($newNik->getDobMonth(), $nik->getDobMonth());
      $this->assertEquals($newNik->getRawDobMonth(), $nik->getRawDobMonth());
      $this->assertEquals($newNik->getDobYear(), $nik->getDobYear());
      $this->assertEquals($newNik->getRawDobYear(), $nik->getRawDobYear());

      $this->assertEquals($newNik->getSequence(), $nik->getSequence());
      $this->assertEquals($newNik->getRawSequence(), $nik->getRawSequence());
      $this->assertEquals($newNik->isFemale(), $nik->isFemale());
      $this->assertEquals($newNik->__toString(), $nik->__toString());
    }
  }

  public function testInvalidInputs(){
    foreach ($this->resources['invalidNikInputs'] as $input){
      try {
        new NikWrapper($input);
      } catch (Throwable $e) {
        $this->assertInstanceOf(InvalidArgumentException::class, $e);
        continue;
      }
      $this->assertTrue(false);
    }
  
    foreach ($this->resources['invalidDobInputs'] as $input){
      try {
        (new NikWrapper($input))->getDob();
      } catch (Throwable $e) {
        $this->assertInstanceOf(InvalidArgumentException::class, $e);
        continue;
      }
      $this->assertTrue(false);
    }
  }
}