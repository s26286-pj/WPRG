<?php

$nationality = array(
    "Polska" => "polak",
    "Niemcy" => "niemiec",
    "Francja" => "francuz"
);

function nationaltyCheck($country, $nationality) {
    if (array_key_exists($country, $nationality)) {
        return $nationality[$country];
    } else {
        return 'Brak w bazie';
    }
}

$country = $argv[1];

echo nationaltyCheck($country, $nationality);
