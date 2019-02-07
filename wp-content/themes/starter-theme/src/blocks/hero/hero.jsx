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
    imageSrc: {
      attribute: 'src',
      selector: '.hero__image'
    },
    imageSrcSet: {
      attribute: 'srcset',
      selector: '.hero__image'
    },

  },
  edit({ attributes, className, setAttributes }) {
    const getImageButton = (openEvent) => {
      if (attributes.imageUrl) {
        return (
          <img
            src={attributes.imageUrl}
            onClick={openEvent}
            className="hero__image image"
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
      <div className="hero container">
        <div className="hero__text">
          <h3>
            <PlainText
              onChange={content => setAttributes({ title: content })}
              value={attributes.title}
              placeholder="Your card title"
              className="heading"
            />
          </h3>

          <RichText
            onChange={content => setAttributes({ body: content })}
            value={attributes.body}
            multiline="p"
            placeholder="Your card text"
          />

          <MediaUpload
            onSelect={media => { setAttributes({ media: media, imageAlt: media.alt, imageUrl: media.url, imageSrcSet: media.srcset }); }}
            type="image"
            value={attributes.imageID}
            render={({ open }) => getImageButton(open)}
          />
        </div>
      </div>
    );
  },
  save({ attributes }) {
    const css = () => {
      return (`
        .hero {
          background-image: url("${attributes.image.src}");
          max-height: ${attributes.image.height}vh;
          height: ${attributes.image.height / attributes.image.width * 100}vw;
        }
      `)
    };

    const heroImage = (src, srcset, alt) => {
      if (!src) return null;

      return (
        <img
          className="hero__image"
          src={src}
          srcset={srcset}
          alt={alt}
        />
      );
    };

    // console.log(media);


    return (
      <div class="hero">
        <div class="hero__content container">
          <h2 class="hero__title">
            {attributes.title}
          </h2>

          <div className="hero__body">
            {attributes.body}
          </div>

          {heroImage(attributes.imageUrl, attributes.imageAlt)}
        </div>
      </div>
    );
  },
});
