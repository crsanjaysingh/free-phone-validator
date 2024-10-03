<?php

use Carbon\Carbon;

if (!function_exists('timeAgo')) {
  function timeAgo($date)
  {
    return Carbon::createFromFormat('m-d-Y H:i:s', $date)->diffForHumans();
  }
}

if (!function_exists('isSubscriptionExpired')) {
  function isSubscriptionExpired($subscription)
  {
    if (isset($subscription->end_date)) {
      echo "Plan expired";
      return Carbon::now()->greaterThan($subscription->end_date);
    }
    return false;
  }
}
