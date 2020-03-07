<?php

function hb_svg( $filename ) {
	$file = get_stylesheet_directory() . '/assets/images/' . $filename . '.svg';
	return file_exists($file) ? file_get_contents($file) : false;
}
