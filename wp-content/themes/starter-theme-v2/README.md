# Starter Theme

## Running Gulp/PostCSS

You can run `npm start` and this will start compiling and BrowserSync the theme folder. Run `npm i` on your first time.

## Adding compiled files to repo

When you are ready to commit final compiled files to the repo, run `lando npm run build` and commit those final files.

## Xdebug

No more `var_dump()`!

Xdebug should be setup on the Lando/VSCode side but there are some prerequisites you need on your local computer:

* A Browser Extension such as [Xdebug Helper](https://chrome.google.com/webstore/detail/Xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc/related)
* The [Xdebug VSCode Extension](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)

If you haven't used Xdebug before, this is [a good tutorial](https://www.youtube.com/watch?v=LNIvugvmCyQ) on how to use it in VSCode. You can skip over the setup stuff.
