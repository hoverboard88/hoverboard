#!/bin/bash

# Syntax to execute via NPM: npm run create-module -- module-name

printf "Creating Part: \"${1}\"";

mkdir parts/${1}
touch parts/${1}/${1}.css
touch parts/${1}/${1}.php

printf "<?php\n/**\n * ${1}\n *\n * @package Hoverboard\n */\n\n?>\n<div class=\"${1}\">\n	<!-- html here -->\n</div>\n" >> parts/${1}/${1}.php
printf ".${1} {\n	/* styles here */\n}\n" >> parts/${1}/${1}.css
