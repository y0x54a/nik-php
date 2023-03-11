# nik-php
[![packagist](https://img.shields.io/packagist/v/y0x54a/nik-php)](https://packagist.org/packages/y0x54a/nik-php)
[![Build Status](https://github.com/y0x54a/nik-php/workflows/ci/badge.svg?branch=main)](https://github.com/y0x54a/nik-php/actions)
[![codecov](https://codecov.io/gh/y0x54a/nik-php/branch/main/graph/badge.svg?token=19XTYSRDLQ)](https://codecov.io/gh/y0x54a/nik-php)

## Installing
```sh
composer require y0x54a/nik-php
```

## Example
```php
use Y0x54a\Nik\Nik;
```

```php
$maleNik = new Nik('0102030405060001');

$maleNik->getRaw();
// 0102030405060001

$maleNik->getProvince();
// 1

$maleNik->getRawProvince();
// 01

$maleNik->getRegency();
// 2

$maleNik->getRawRegency();
// 02

$maleNik->getDistrict();
// 3

$maleNik->getRawDistrict();
// 03

$maleNik->getDob();
// DateTime(..06-05-04)

$maleNik->getRawDob();
// 040506

$maleNik->getDobDay();
// 4

$maleNik->getRawDobDay();
// 04

$maleNik->getDobMonth();
// 5

$maleNik->getRawDobMonth();
// 05

$maleNik->getDobYear();
// 6

$maleNik->getRawDobYear();
// 06

$maleNik->getSequence();
// 1

$maleNik->getRawSequence();
// 0001

$maleNik->isFemale();
// false

$maleNik->__toString();
// 0102030405060001
```

```php
$femaleNik = new Nik('0102034405060001');

$femaleNik->getRaw();
// 0102034405060001

$femaleNik->getProvince();
// 1

$femaleNik->getRawProvince();
// 01

$femaleNik->getRegency();
// 2

$femaleNik->getRawRegency();
// 02

$femaleNik->getDistrict();
// 3

$femaleNik->getRawDistrict();
// 03

$femaleNik->getDob();
// DateTime(..06-05-04)

$femaleNik->getRawDob();
// 440506

$femaleNik->getDobDay();
// 44

$femaleNik->getRawDobDay();
// 44

$femaleNik->getDobMonth();
// 5

$femaleNik->getRawDobMonth();
// 05

$femaleNik->getDobYear();
// 6

$femaleNik->getRawDobYear();
// 06

$femaleNik->getSequence();
// 1

$femaleNik->getRawSequence();
// 0001

$femaleNik->isFemale();
// true

$femaleNik->__toString();
// 0102034405060001
```

## API

- ### NikInterface

  - **Methods**

  - `getRaw(): string`
  
  - `getProvince(): int`

  - `getRawProvince(): string`
  
  - `getRegency(): int`

  - `getRawRegency(): string`

  - `getDistrict(): int`

  - `getRawDistrict(): string`

  - `getDob(): DateTimeInterface`

  - `getRawDob(): string`

  - `getDobDay(): int`

  - `getRawDobDay(): string`

  - `getDobMonth(): int`

  - `getRawDobMonth(): string`

  - `getDobYear(): int`

  - `getRawDobYear(): string`

  - `getSequence(): int`

  - `getRawSequence(): string`

  - `isFemale(): bool`

  - `__toString(): string`

- ### Nik

  - **Methods**

  - `__construct(string | NikInterface $raw)`

  - `getRaw(): string`
  
  - `getProvince(): int`

  - `getRawProvince(): string`
  
  - `getRegency(): int`

  - `getRawRegency(): string`

  - `getDistrict(): int`

  - `getRawDistrict(): string`

  - `getDob(): DateTimeInterface`

  - `getRawDob(): string`

  - `getDobDay(): int`

  - `getRawDobDay(): string`

  - `getDobMonth(): int`

  - `getRawDobMonth(): string`

  - `getDobYear(): int`

  - `getRawDobYear(): string`

  - `getSequence(): int`

  - `getRawSequence(): string`

  - `isFemale(): bool`

  - `__toString(): string`