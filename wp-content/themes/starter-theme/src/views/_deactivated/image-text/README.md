Image/Text Module
=================

This module is used for anything that has an image and text together. This can of course be modified to your liking as this is just a starter.

See attached ACF json file for example.

Example code to call module:

```
{% include 'image-text/image-text.twig' with {
  'image': fields.image_text_image,
  'title': fields.image_text_title,
  'body': fields.image_text_body,
} %}
```