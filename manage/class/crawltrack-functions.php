<?php
function date_difference($date1, $date2){

/**
 * Calculates the differences between two date
 *
 * @param date $date1
 * @param date $date2
 * @return array
 */

//http://fr.php.net/manual/fr/function.strtotime.php
//http://php.net/manual/fr/function.mktime.php

$d1 = (is_string($date1) ? strtotime($date1) : $date1);
$d2 = (is_string($date2) ? strtotime($date2) : $date2);

$diff_secs = abs($d1 - $d2);
$base_year = min(date("Y", $d1), date("Y", $d2));

$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

return array(
		"years" => abs(substr(date('Ymd', $d1) - date('Ymd', $d2), 0, -4)),
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,

		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)

	);

}