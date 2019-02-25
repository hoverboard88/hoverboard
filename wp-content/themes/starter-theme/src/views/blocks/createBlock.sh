#!/bin/bash

printf "Creating Block: \"${1}\"";

mkdir ${1}
cp ../_deactivated/block-boilerplate/block-boilerplate.jsx ${1}/${1}.jsx

# TODO: Search and replace boilerplate jsx file
printf ".${1} {\n  /* Front-end styles here */\n}" >> ${1}/${1}.view.css
printf "/* Back-end (block editor) styles here. These should be pretty minimal. */" >> ${1}/${1}.editor.css

printf "\nimport '../views/blocks/${1}/${1}.jsx';" >> ../../js/blocks.js
