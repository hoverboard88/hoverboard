#!/bin/bash

cd wp-content/mu-plugins
git clone https://github.com/hoverboard88/hb-server.git
if [ ! -e ./hb-server.php ]; then ln -s ./hb-server/hb-server.php hb-server.php; fi
cd hb-server
git pull origin main
