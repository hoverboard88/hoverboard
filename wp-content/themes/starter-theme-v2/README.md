# Starter Theme

## Running Gulp/PostCSS

You can run `lando npm start` and this will run inside the node container that Lando created and gives you a browsersync url (ex: `https://bs.hoverboard-custom.lndo.site`).

If you don't want to, you can also just run `npm start`.

**Note:** Whichever you chose, make sure to run `npm install` or `lando npm install` with your corresponding method. Installing in one and running in the other can cause inproper modules installed based on the OS (Mac/docker container).

## Adding compiled files to repo

When you are ready to commit final compiled files to the repo, run `lando npm run build` and commit those final files.

## Xdebug

No more `var_dump()`!

Xdebug should be setup on the Lando/VSCode side but there are some prerequisites you need on your local computer:

* A Browser Extension such as [Xdebug Helper](https://chrome.google.com/webstore/detail/Xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc/related)
* The [Xdebug VSCode Extension](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)

If you haven't used Xdebug before, this is [a good tutorial](https://www.youtube.com/watch?v=LNIvugvmCyQ) on how to use it in VSCode. You can skip over the setup stuff.
