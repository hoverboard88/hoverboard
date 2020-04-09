#!/bin/bash

# Syntax to execute via NPM: npm run create-module -- module-name

printf "Creating Module: \"${1}\"";

mkdir modules/${1}
touch modules/${1}/${1}.css
touch modules/${1}/${1}.php

printf "<?php\n/**\n * ${1}\n *\n * @package Hoverboard\n */\n\n?>\n<div class=\"${1}\">\n	<!-- html here -->\n</div>\n" >> modules/${1}/${1}.php
printf ".${1} {\n	/* styles here */\n}\n" >> modules/${1}/${1}.css
