<?php declare(strict_types=1);

namespace Y0x54aTest\Nik;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Y0x54a\Nik\NikInterface;
use Y0x54a\Nik\StringableInterface;

class NikInterfaceTest extends TestCase
{
  public function testIsInterface(){
    $rc = new ReflectionClass(NikInterface::class);
    $this->assertTrue($rc->isInterface());
  }

  public function testIsSubclassOfStringableInterface(){
    $rc = new ReflectionClass(NikInterface::class);
    $this->assertTrue($rc->isSubclassOf(StringableInterface::class));
    if (PHP_VERSION_ID >= 80000) {
      $this->assertTrue($rc->isSubclassOf(\Stringable::class));
    }
  }
}