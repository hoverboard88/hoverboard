Menu Module
===========

Outputs a generic `<ul>` based menu based on the menu that is passed to it.

If creating a new menu:

1. Copy this module to `src/views` and rename from `menu` to `{name}-menu`.
2. Update all classes in twig file and css appropriately.
3. Add it to the `$this->menus` array in `functions.php` and use your slug from that to pass into the include below.

```
{% include "menu/menu.twig" with {
  'menu': my_menu.get_items
} %}
```
