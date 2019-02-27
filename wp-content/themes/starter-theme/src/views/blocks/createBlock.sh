#!/bin/bash

printf "Creating Block: \"${1}\"";

mkdir ${1}
touch ${1}/${1}.view.css
touch ${1}/${1}.editor.css
touch ${1}/${1}.twig

printf "<div class=\"${1} align{{align_style}}\">\n\n</div>" >> ${1}/${1}.twig
printf ".${1} {\n  /* Styles here */\n}" >> ${1}/${1}.editor.css
printf ".${1} {\n  /* Styles here */\n}" >> ${1}/${1}.view.css

# TODO: Add `$this->register_block` to functions.php? Might have to break it into a separate file so you can append to it.
