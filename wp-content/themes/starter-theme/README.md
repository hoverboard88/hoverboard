Hoverboard Starter Theme
========================

## Stack ##

The following are used in our theme stack:

* Timber: For theme framework using Twig templating language
* ACF: For admin options
* [Webpack](https://webpack.js.org): For Javascript and PostCSS compiling.
  * Lando: Used for local development
  * PostCSS: Compiles the following down to IE11+ compliance:
    * CSS Variables
    * Nesting
    * Mixins (Maybe? Haven't tested yet)
  * Babel: Compiles ES6 Javascript down to IE11+ compliance

## Lando ##

See [documentation](https://gitlab.com/hoverboard88/internal-tools/process-wiki/wikis/Hosting-Setup#user-content-setup-site-locally) on Hoverboard Wiki.

## Modules ##

Modules are used to keep design elements scoped within themselves. We use [BEM](https://getbem.com/naming/) for the class structure. Templating is based in Twig.

### Starter (deactivated) Modules ###

We have a directory in `src/views/_deactivated` which holds modules you may want to use. This folder is excluded from the build process.

Before creating a new module, look in the `src/views/_deactivated` directory to see if your module isn't in there already.

To activate one, move the module out to `/src/views`, restart `npm start`.

### Creating Module ###

To create a new module you can run the `createModule.sh` script from it's current directory:

```
cd src/views
./createModule.sh
```

### Javascript ###

If you need a javascript file in your module, create `MODULE_NAME.js` in it's folder and add a data attribute to the parent element in the template:

```
<section class="accordion" data-init-js="accordion" data-options-js='{"open":true}'>
```

`data-init-js` initializes the Javascript code scoped to that element and `data-options-js` passes in any paremeters to your Javascript.

#### Starting the Javascript file ####

The Javascript is using a Class to structure the code. Here is a starter:

```
class MyModuleName {
  constructor(element, options) {
    this.element = element;
    this.options = options;
  }

  init() {
    // Do javascript stuff
  }
}

export default MyModuleName;
```

Feel free to break things out into functions within the Class.

## Creating Flexible Content Sections ##

ACF has [Flexible Content](https://www.advancedcustomfields.com/resources/flexible-content/) for content blocks on the site. These are already setup to loop and display on the `page.twig` file and will pass all of the sub fields into a `fields` object.

To use with modules above, ensure the name of your "Name" field in the admin is the same as the module folder/file name (ex: test-flex-content).

There is already a `post-content` module that can be added in the Wordpress admin to position the content correctly on the page. For example, if you want it under the Hero banner.

### Custom Post Types ###

If you want to use this on Custom Post Types, grab the for loop on `page.twig and move to your single-[cpt].twig file. You'll also need to add an "or" statement under Location in the ACF admin page.

### Using on Posts ###

This will be similar to CPT's above except using `post` for the post type. Keep in mind too that blog posts might not need content sections as they are generally tubes of content.

## Creating Wordpress Template File ##

1. Create the appropriate php file on the theme's root (ex: page-about.php) using page-home.php as a guide.
2. Change the Template name in the php comment.
3. Create a coorisponding `.twig` file in `src/views/`.

## style.css file on root ##

This is required for Wordpress themes but we aren't using it. Do not add any styles into this file.

## Production/Dev Build process ##

To keep commits down on compiled files in the repository, we have 2 build processes:

* `npm start`: Runs the `dev` build that creates `dist/*/dev.*` files which are ignored from the repository. There is a flag in the theme that enqueues these files _only_ on Lando environments.
* `npm run build`: Runs the `build` process that creates `dist/*/bundle.*` files which are tracked in the repository and will render on any environment except Lando.

When the build process is trigged is still a word in progress. Ideally, we want to have a GitLab pipeline. For now, let Matt or Ryan do it via their own branch/commit.
