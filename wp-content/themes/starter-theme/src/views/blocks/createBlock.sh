#!/bin/bash

printf "Creating Block: \"${1}\"";

mkdir ${1}
touch ${1}/${1}.css

# TODO: Create block from boilerplate .jsx file
# printf "<div class=\"${1} align{{align_style}}\">\n\n</div>" >> ${1}/${1}.twig
printf ".${1} {\n  /* Styles here */\n}" >> ${1}/${1}.css

printf "import '../views/blocks/${1}/${1}.jsx';" >> ../../js/blocks.js
