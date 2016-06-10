<?php

/* function strips centigrade symbol from temerature value and
** converts to int, so it could be useful in comparation operations
*/

function tempstring_to_int($tempstring) {

	$tempint = intval(substr($tempstring, 0, -3));
	return $tempint;
}

/* function strips percentage symbol from health value and converts
** to int, so it could be useful in comparation operations
*/

function healthstring_to_int($healthstring) {

	$healthint = intval(substr($healthstring, 0, -1));
	return $healthstring;
}