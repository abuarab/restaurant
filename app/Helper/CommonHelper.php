<?php

namespace App\Helpers;

class CommonHelper {

    /**
     * @param $gram
     * @return float|int
     *
     * convert from gram to kg
     */
    public static function convertGToKg($gram) {
        return $gram / 1000;
    }

    /**
     * @param $kGram
     * @return float|int
     *
     * convert from kg to g
     */
    public static function convertKgToG($kGram) {
        return $kGram * 1000;
    }
}
