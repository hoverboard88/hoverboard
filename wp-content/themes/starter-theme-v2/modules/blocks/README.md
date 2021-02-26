# Blocks

Use `hb acf block` to create a new block.

## Gravity Forms

If your block has a Gravity Form in it, make sure to add this snippet to `enqueue.php` where `1` is the Form ID:

```
if ( function_exists( 'gravity_form_enqueue_scripts' ) ) {
	gravity_form_enqueue_scripts( 1, true );
}
```

This will put jQuery in the `<head>` and avoid a JavaScript error.

If you use the plain Gravity Form Block that comes with the plugin, you don't have to do any of this.
