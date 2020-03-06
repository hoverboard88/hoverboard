#!/bin/bash

# Syntax to execute via NPM: npm run create-module -- module-name

printf "Creating Module: \"${1}\"";

mkdir modules/${1}
touch modules/${1}/${1}.css
touch modules/${1}/${1}.php

printf "<div class=\"${1}\">\n  <!-- Styles here -->\n</div>" >> modules/${1}/${1}.php
printf ".${1} {\n\n}" >> modules/${1}/${1}.css
