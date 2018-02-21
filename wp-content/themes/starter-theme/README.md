Hoverboard Starter Theme
========================

## Creating Module ##

To create a new module you can run the `createModule.sh` script from it's current directory:

```
cd src/views
./createModule.sh
```

If you need a javascript file, create `MODULE_NAME.js` in it's folder and add an import statement to `src/js/main.js`.

## Creating Flexible Content Sections ##

ACF has [Flexible Content](https://www.advancedcustomfields.com/resources/flexible-content/) for content blocks on the site. These are already setup to loop and display on the `page.twig` file and will pass all of the sub fields into a `fields` object.

To use with modules above, ensure the name of your "Name" field in the admin is the same as the module folder/file name (ex: test-flex-content).

There is already a `post-content` module that can be added in the Wordpress admin to position the content correctly on the page. For example, if you want it under the Hero banner.

### Using on Posts ###

**To be documentented.** Presumably, it will be similar to CPT's below. Keep in mind too that blog posts might not need content sections as they are generally tubes of content.

### Custom Post Types ###

If you want to use this on Custom Post Types, grab the for loop on `page.twig and move to your single-[cpt].twig file. You'll also need to add an "or" statement under Location in the ACF admin page.

## Creating Wordpress Template File ##

1. Create the appropriate php file in the `templates/` directory (ex: page-about.php) using page-home.php as a guide.
2. Change the Template name in the php comment.
3. Create a coorisponding `.twig` file in `src/views/`.

## style.css file on root ##

This is required for Wordpress themes but we aren't using it. Do not add any styles into this file.