<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convert($number)
    {
        // ✅ GLOBAL PHP CLASS (VERY IMPORTANT BACKSLASH)
        $formatter = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);

        return ucwords($formatter->format($number)) . ' Rupees Only';
    }
}
