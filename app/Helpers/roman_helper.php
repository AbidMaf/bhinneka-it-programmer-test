<?php

function intToRomanNumeral(int $num) {
    static $nf = new NumberFormatter('@numbers=roman', NumberFormatter::DECIMAL);
    return $nf->format($num);
}