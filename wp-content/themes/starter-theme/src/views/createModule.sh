#!/bin/bash

printf "Creating Module: \"${1}\"";

mkdir ${1}
touch ${1}/${1}.css
touch ${1}/${1}.twig