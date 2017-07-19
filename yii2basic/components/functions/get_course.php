<?php

function get_course ($curr = 'RUR')
{
	$data = file_get_contents(LINK_COURS);

	if(!$data) return false;

	$courses = json_decode($data, true);

	$curr_c = false;

	foreach ($courses as $course) {

		if($course['ccy'] == $curr) {

			return $course['buy'];
		}
	}

}