#!/bin/bash

printf "Creating Module: \"${1}\"";

mkdir ${1}
touch ${1}/${1}.css
touch ${1}/${1}.twig

printf "<div class=\"${1}\">\n  \n</div>" >> ${1}/${1}.twig
printf ".${1} {\n\n}" >> ${1}/${1}.css
