<?php

$count = isset($_COOKIE['count']) ? $_COOKIE['count'] : 0;
$isNotRefreshed = !(isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
if ($isNotRefreshed) {
    setcookie('count', $count + 1, time() + (60 * 60 * 24));
}

if ($count >= 8) {
  echo "Zawartość";
} else {
  echo $count + 1;
}
