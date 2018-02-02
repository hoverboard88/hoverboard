Hoverboard Starter Theme
========================

## Creating Module ##

To create a new module you can run the `createModule.sh` script from it's current directory:

```
cd src/views
./createModule.sh
```

If you need a javascript file, create `MODULE_NAME.js` in it's folder and add an import statement to `src/js/main.js`.

## Creating Wordpress Template File ##

1. Create the appropriate php file in the `templates/` directory (ex: page-about.php) using page-home.php as a guide.
2. Change the Template name in the php comment.
3. Create a coorisponding `.twig` file in `src/views/`.

## style.css file on root ##

This is required for Wordpress themes but we aren't using it. Do not add any styles into this file.