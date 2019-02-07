const { __ } = wp.i18n;
const { RichText, MediaUpload, PlainText, userAutocompleter } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;

registerBlockType('starter-theme/hero', {
  title: __('Hero'),
  icon: 'format-image',
  category: 'common',
  attributes: {
    title: {
      source: 'text',
      selector: '.hero__title'
    },
    body: {
      type: 'array',
      source: 'children',
      selector: '.hero__body'
    },
    imageAlt: {
      attribute: 'alt',
      selector: '.hero__image'
    },
    imageUrl: {
      attribute: 'src',
      selector: '.hero__image'
    }
  },
  edit({ attributes, className, setAttributes }) {
    const getImageButton = (openEvent) => {
      if (attributes.imageUrl) {
        return (
          <img
            src={attributes.imageUrl}
            onClick={openEvent}
            className="image"
          />
        );
      }
      else {
        return (
          <div className="button-container">
            <Button
              onClick={openEvent}
              className="button button-large"
            >
              Pick an image
        </Button>
          </div>
        );
      }
    };

    return (
      <div className="container">
        <h3>
          <PlainText
            onChange={content => setAttributes({ title: content })}
            value={attributes.title}
            placeholder="Your card title"
            className="heading"
          />
        </h3>

        <MediaUpload
          onSelect={media => { setAttributes({ imageAlt: media.alt, imageUrl: media.url }); }}
          type="image"
          value={attributes.imageID}
          render={({ open }) => getImageButton(open)}
        />

        <RichText
          onChange={content => setAttributes({ body: content })}
          value={attributes.body}
          multiline="p"
          placeholder="Your card text"
        />
      </div>
    );
  },
  save({ attributes }) {
    const cardImage = (src, alt) => {
      if (!src) return null;

      if (alt) {
        return (
          <img
            className="card__image"
            src={src}
            alt={alt}
          />
        );
      }

      // No alt set, so let's hide it from screen readers
      return (
        <img
          className="card__image"
          src={src}
          alt=""
          aria-hidden="true"
        />
      );
    };

    return (
      <div class="hero">
        <div class="hero__content container">
          <h2 class="hero__title">
            {attributes.title}
          </h2>

          <div className="hero__body">
            {attributes.body}
          </div>
        </div>

        {cardImage(attributes.imageUrl, attributes.imageAlt)}
      </div>
    );
  },
});
