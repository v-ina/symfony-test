<?php

declare(strict_types=1);

function addNumber(int $number1, int $number2): int{
    return $number1 + $number2;
}

// 그래서 얘는 당연히 안됨
// addNumber("hello", false);

$result = addNumber(2,4);