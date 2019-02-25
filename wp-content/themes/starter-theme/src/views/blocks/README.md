Wordpress Content Blocks
========================

Blocks are created via Advanced Custom Fields plugin and live in a folder `src/views/blocks`. We want to keep these separate so it is apparent which modules are blocks and which are normal modules.

## Creating a Block ##

1. Use `src/views/blocks/createBlock.sh` to create a new block, making the first and only parameter your block name.
1. In `functions.php` under `function blocks_init()`, add a `$this->register_block`, copying one of the existing blocks.
  * `name`: The slug of the block. Has to match the name of the module in the folder structure.
  * `title`: Shows on WP Editor.
  * `description`: Shows on WP Editor.
  * `category`: Category the block will be under in the WP Editor. TODO: Find a list of available categories online.
  * `icon`: Icon to use using [Dashicons](https://developer.wordpress.org/resource/dashicons/).
  * `keywords`: Keywords the user can search by to find the block in the WP Editor.
2. In the Wordpress admin, go to Custom Fields.
3. Create a new group called `Block: my_block_name`.
4. Create all needed ACF's.
5. Under Location Rules set to `Block` `is equal to` `[block_registered]`.
6. Save Group.

## Block Layout/Alignment ##

The block editor does **not** wrap divs around most blocks (like paragraphs, lists). The theme is currently setup assuming your content area blocks span the whole width of the page.

If you have a main/side column setup on some pages, you will probably want to create a `main-column` module in lieu of `post-content` on those templates. If all pages/archives have this layout, you may want to change up `post-content` altogether.

## Block Markup ##

All of your ACF's come in from an object called `fields`.

### Alignment ###

Out of the box, the block editor gives the user 5 alignment options:

* left
* center
* right
* wide
* full

This option comes in as a variable called `{{align_style}}`. Generally, you want to add this to a div as `align{{align_style}}` so it uses the Wordpress styles (See `wordpress.css`). However, if you have soemthing like a wrapping div that spans the whole window width, you may want to change this up to use a modifier (ex: `.hero--{{align_style}}) and customize the layout.

**Make sure to test all alignments with your block.**

### JS Init ###

Unlike a normal module, the data attribute for intializing the JavaScript is a little different. It is using `data-block-init-js` instead of `data-init-js`.

```
<section class="accordion align{{align_style}}" data-block-init-js="accordion" data-options-js='{"open": {{fields.first_section}} }'>
```

NOTE: This is because the path includes `/block`. See `main.js` for details.

## Testing ##

In addition to testing your block, make sure to test all of the default Wordpress blocks with your theme to ensure they are working well. If you find one that is not working well and could be solved by adding to the `starter-theme`, create an issue in GitLab so we can fix that moving forward.

## Selective Blocks ##

If you only want blocks on certain Post Types, you can use the [Gutenberg Ramp](https://wordpress.org/plugins/gutenberg-ramp/) plugin.


### One line editable text ###
```
content: {
  type: 'array',
  source: 'children',
  selector: 'h1',
  default: 'Editable block content…',
},
```
