Pagination Module
=================

Creates a base for pagination. More than likely place on `index.twig` and pass in `posts.pagination` like so:

```
{% include "pagination/pagination.twig" with {
  'pagination': posts.pagination,
} %}
```
