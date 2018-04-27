Menu Module
===========

Recursively outputs a generic `<ul>` based menu based on the menu that is passed to it.

If creating a new menu:

1. Create a `my-menu.css` file inside `src/views/menu`
2. Style appropriately.
3. Add menu to the `$this->menus` array in `functions.php`.
  * ```
    [
      'name' => 'My Menu',
      'slug' => 'my_menu',
    ],
    ```
4. Use your slug from that to pass into the include below
  * ```
    {% include "menu/menu.twig" with {
      'menu_name': 'my-menu',
      'menu': my_menu.get_items
    } %}
    ```
