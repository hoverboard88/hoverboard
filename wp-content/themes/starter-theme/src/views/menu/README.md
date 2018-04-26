Menu Module
===========

Outputs a generic `<ul>` based menu based on the menu that is passed to it.

Example `include` twig html:

```
{% include "menu/menu.twig" with {
  'menu': header_menu.get_items
} %}
```