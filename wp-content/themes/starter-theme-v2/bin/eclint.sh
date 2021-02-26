#!/bin/bash

if [ $1 == 'fix' ]
then
	npx eclint fix $(git ls-files);
else
	npx eclint check $(git ls-files);
fi
