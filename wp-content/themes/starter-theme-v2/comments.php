<?php
/**
 * Comments
 *
 * This file is required by WordPress; Referencing the module
 *
 * @package Hoverboard
 */

get_template_part(
	'parts/comments/comments',
	null,
	array(
		'comments' => $args['comments'],
	)
);
