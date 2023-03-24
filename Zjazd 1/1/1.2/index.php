<?php

function getCirrulumference($radius) {
    return 2 * M_PI * $radius;
}

$radius = $argv[1];

echo getCirrulumference($radius);