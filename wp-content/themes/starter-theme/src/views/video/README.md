Video Module
============

Video module can give admin choice of upload or oEmbed. See attached ACF json file for example.

Example code to call module:

```
{% include 'video/video.twig' with {
  'type': post.video_type,
  'embed': post.video_embed,
  'upload_url': function('wp_get_attachment_url', post.video_upload),
  'upload_mime_type': function('wp_get_attachment_metadata', post.video_upload).mime_type
} %}
```