#!/bin/bash

# Syntax to execute via NPM: npm run create-block -- block-name

printf "Creating Block: \"${1}\"";

./bash_scripts/createModule.sh ${1}

touch modules/blocks/${1}.php

printf "<?php\n/**\n * ${1} Block\n *\n * @package Hoverboard\n */\n\n?>\n<div class=\"${1}-block align<?php echo esc_html( \$align_style ); ?>\">\n	<?php\n	the_module(\n		'${1}',\n		\$fields,\n	);\n	?>\n</div>\n" >> modules/blocks/${1}.php

printf "\nhb_register_block(\n	array(\n		'name'        => '${1}',\n		'title'       => __( '${1}' ),\n		'description' => __( 'DESCRIPTION OF BLOCK.' ),\n		'category'    => 'layout',\n		'icon'        => 'list-view',\n		'keywords'    => array(),\n	)\n);\n" >> inc/blocks.php
