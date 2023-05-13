<?php

$count = isset($_COOKIE['count']) ? $_COOKIE['count'] : 0;
setcookie('count', $count + 1, time() + (60 * 60 * 24));

if ($count >= 8) {
  echo "Zawartość";
} else {
  echo $count + 1;
}
