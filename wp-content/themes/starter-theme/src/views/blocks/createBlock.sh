#!/bin/bash

echo "Is this an React block? (yes/no)"
read REACT

printf "Creating Block: \"${1}\"\n";

mkdir ${1}

if [ "$REACT" == "yes" ]; then
  cp ../_deactivated/block-boilerplate/block-boilerplate.jsx ${1}/${1}.jsx
  sed -i -e "s/BLOCK_NAME/${1}/g" ${1}/${1}.jsx

  printf "\nimport '../views/blocks/${1}/${1}.jsx';" >> ../../js/blocks.js
else
  touch ${1}/${1}.twig

  printf "<div class=\"${1} align{{align_style}}\">\n\n</div>" >> ${1}/${1}.twig
fi


touch ${1}/${1}.view.css
touch ${1}/${1}.editor.css

printf ".${1} {\n  /* Front-end styles here */\n}" >> ${1}/${1}.view.css
printf "/* Back-end (block editor) styles here. These should be pretty minimal. */" >> ${1}/${1}.editor.css