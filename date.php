<?php
require __DIR__ . "/vendor/autoload.php";
date_default_timezone_set('Africa/Lagos');

use Carbon\Carbon;

$date = Carbon::now();
echo $date;
echo "<br/>";
$today = Carbon::today();
echo $today;
echo "<br/>";
$tommorrow = Carbon::tomorrow();
echo $tommorrow;
echo "<br/>";

$fm = Carbon::now()->addMinutes(5);
echo $fm;
echo "<br />";

$ty = $date->addYear(5);
echo $ty;
