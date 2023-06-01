<?php

if (!function_exists('xformatted_runtime')) {
    function oxy_get_formatted_runtime(int|float $minutes): string
    {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        $minsString = str_pad($mins, 2, '0', STR_PAD_LEFT);

        return $hours . 'h' . $minsString . 'm';
    }
}

if (!function_exists('xformatted_dollar')) {
    function xformatted_dollar($amount, $precision = 2)
    {
        $amount = round($amount / 1000000, $precision);
        if ($amount == 0) {
            return $amount;
        }
        if ($amount > 1) {
            $amount = str($amount)->append('M');
        } else {
            $amount = str($amount)->append('K');
        }
        return str($amount)->prepend('$')->toString();
    }
}

if (!function_exists('a')) {
    function a($b)
    {
    }
}
