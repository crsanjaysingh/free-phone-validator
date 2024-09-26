<?php

use Carbon\Carbon;

if (!function_exists('timeAgo')) {
  function timeAgo($date)
  {
    return Carbon::createFromFormat('m-d-Y H:i:s', $date)->diffForHumans();
  }
}
