<?php
// header('Content-type: text/html; charset=utf-8');

function get_course ($curr = 'RUR')
{
// function dd($val) {
// 	echo '<pre>';
// 	print_r($val);
// 	echo '</pre>';die;
// }


$url = 'https://privatbank.ua/';
$file = file_get_contents($url);

$pattern = '#<table id="course-table-pb.+?</table>#s';
preg_match($pattern, $file, $matches);

print_r($matches);

// 	$data = file_get_contents(LINK_COURS);

// 	if(!$data) return false;

// 	$courses = json_decode($data, true);

// 	$curr_c = false;

// 	foreach ($courses as $course) {

// 		if($course['ccy'] == $curr) {

// 			return $course['buy'];
// 		}
// 	}

}