<?php

namespace App\Helpers;

abstract class StringHelper
{
    /**
     * Return only letters in a string
     * @param string $string the string that will be filtered
     * @param string $case type of filter (BOTH = upper and lower case returns | UPPER = upper case returns | LOWER = lower case returns)
     * @return string
     */
    public static function onlyLetters($string, $case = 'BOTH')
    {
        if ($case == "BOTH") {
            return preg_replace("/[^a-zA-Z]+/", '', $string);
        } else if ($case == "UPPER") {
            return preg_replace("/[^A-Z]+/", '', $string);
        } else if ($case == "LOWER") {
            return preg_replace("/[^a-z]+/", '', $string);
        } else {
            return preg_replace("/[^a-zA-Z]+/", '', $string);
        }
    }
}
