<?php return [
  'validInputs' => [
    // male
    ['0102031506500001', 1, 2, 3, '0050-06-15', '150650', 15, 6, 50, 1, false],
    ['0102031406500001', 1, 2, 3, '0050-06-14', '140650', 14, 6, 50, 1, false],
    ['0102031606500001', 1, 2, 3, '9950-06-16', '160650', 16, 6, 50, 1, false],
    ['0102031504500001', 1, 2, 3, '0050-04-15', '150450', 15, 4, 50, 1, false],
    ['0102031507500001', 1, 2, 3, '9950-07-15', '150750', 15, 7, 50, 1, false],
    ['0102031506490001', 1, 2, 3, '0049-06-15', '150649', 15, 6, 49, 1, false],
    ['0102031506510001', 1, 2, 3, '9951-06-15', '150651', 15, 6, 51, 1, false],
    // female
    ['0102035506500001', 1, 2, 3, '0050-06-15', '550650', 55, 6, 50, 1, true],
    ['0102035406500001', 1, 2, 3, '0050-06-14', '540650', 54, 6, 50, 1, true],
    ['0102035606500001', 1, 2, 3, '9950-06-16', '560650', 56, 6, 50, 1, true],
    ['0102035504500001', 1, 2, 3, '0050-04-15', '550450', 55, 4, 50, 1, true],
    ['0102035507500001', 1, 2, 3, '9950-07-15', '550750', 55, 7, 50, 1, true],
    ['0102035506490001', 1, 2, 3, '0049-06-15', '550649', 55, 6, 49, 1, true],
    ['0102035506510001', 1, 2, 3, '9951-06-15', '550651', 55, 6, 51, 1, true]
  ],
  'invalidNikInputs' => [
    '0002030405060001',
    '0100030405060001',
    '0102000405060001',
    '0102030405060000'
  ],
  'invalidDobInputs' => [
    '0102030005060001',
    '0102039905060001',
    '0102030400050001',
    '0102030499050001',
    '0102033102000001'
  ]
];