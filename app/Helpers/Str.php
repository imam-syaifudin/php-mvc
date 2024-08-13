<?php

namespace App\Helpers;

class Str
{

    public static function camelToSnakeString(string $string): string
    {
        foreach (str_split($string) as $index => $str) {
            $str === strtoupper($str) && $index !== 0 ?
                $string = substr_replace($string, " ", $index, 0) : '';
        }

        return strtolower(str_replace(" ", "_", $string)) . "s";
    }


    public static function extractPlaceholders(string $path): array
    {
        $pattern = '/\{([a-zA-Z0-9_]+)\}/';
        preg_match_all($pattern, $path, $matches);
        return $matches[1];
    }

    public static function arrToString(array $data, $delimiter = ","): string
    {
        return implode($delimiter, $data);
    }

    public static function repeatFromArray(array $array, string $delimiter): string
    {

        $result = "";

        foreach ($array as $index => $value) {

            $formatValue = $value . "=:$value";

            if ( $index === 0 ) {
                $result .= $formatValue;
                continue;
            }

            $result .= $delimiter . $formatValue;
        }

        return $result;
    }
}
