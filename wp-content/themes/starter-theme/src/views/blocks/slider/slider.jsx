const {
  registerBlockType,
} = wp.blocks;

const {
  MediaUpload,
  InnerBlocks,
  RichText,
  Button,
} = wp.editor;

const {
  select,
} = wp.data;

registerBlockType('starter-theme/slider', {
  title: 'Slider',
  icon: 'welcome-write-blog',
  category: 'common',
  supports: {
    align: true,
  },
  attributes: {
    innerCount: {
      type: 'number',
      default: 0,
    },
  },

  // The editor "render" function
  edit(props) {
    const { clientId, alignment } = props;

    // find number of children and set it as an attribute
    const innerCount = select('core/editor').getBlocksByClientId(clientId)[0].innerBlocks.length;
    props.setAttributes({ clientId, innerCount });

    return (
      <InnerBlocks
        template={[
          ['starter-theme/slider-item', {
            text: 'Some slide text…',
          }],
        ]}
        allowedBlocks={
          ['starter-theme/slider-item']
        }
      />
    );
  },

  // The save "render" function
  save(props) {
    const { innerCount, alignment } = props.attributes;
    const alignment_class = `align${alignment}`;

    const bullets = (count) => {

      var items = [];

      for (var index = 0; index < count; index++) {
        // TODO: Buttons don't click on Front End
        items.push(<button class="slider__bullet" data-glide-dir={index}>
          {index + 1}
        </button>);
      }

      return (
        {items}
      )
    };

    const pagination = count => {
      if (count < 2) return null;

      return (
        <div>
          <div class="slider__arrows" data-glide-el="controls">
            <button class="slider__arrow slider__arrow--prev" data-glide-dir="&lt;">
              {/* TODO: Render SVG */}
              arrow-left
            </button>
            <button class="slider__arrow slider__arrow--next" data-glide-dir="&gt;">
              arrow-right
            </button>
          </div>

          <div class="slider__bullets" data-glide-el="controls[nav]">
            {bullets(innerCount)}
          </div>
        </div>
      );
    };

    return (
      <div className={alignment_class}>
        <section className="slider" data-block-init-js="slider" data-options-js='{}'>
          <div className="js-slider">
            <div data-glide-el="track" className="slider__track">
              <ul data-glide-el="slides" className="slider__slides">
                <InnerBlocks.Content />
              </ul>
            </div>

            {pagination(innerCount)}

          </div>
        </section>
      </div>
    );
  }
});

registerBlockType('starter-theme/slider-item', {
  title: 'Slider Item',
  icon: 'welcome-write-blog',
  category: 'common',
  parent: ['starter-theme/slider'],
  attributes: {
    title: {
      source: 'text',
      selector: '.slider__title'
    },
    text: {
      type: 'array',
      source: 'children',
      selector: '.slider__text'
    },
    image: {
      source: 'array',
      selector: '.slider__image',
      default: {
        src: `https://placehold.it/1400x600`,
        alt: `Placeholder`,
      }
    }
  },

  // The editor "render" function
  edit(props) {
    let { image, text } = props.attributes;

    function onChangeImage(updatedImage) {
      props.setAttributes({
        image: {
          src: updatedImage.sizes.large.url,
          alt: updatedImage.alt,
        }
      });
    }

    const getImageButton = (openEvent) => {
      if (image.src) {
        return (
          <img
            src={image.src}
            onClick={openEvent}
            className="slide__image"
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
      <div className="slider__slide">
        <MediaUpload
          type="image"
          onSelect={onChangeImage}
          render={({ open }) => getImageButton(open)}
        />

        <div className="slider__text">
          <InnerBlocks
            template={[
              ['core/heading', {
                placeholder: 'Slide Heading',
              }],
              ['core/paragraph', {
                placeholder: 'Slide Text',
              }],
              ['core/button', {
                placeholder: 'Button Text',
              }],
            ]}
            allowedBlocks={
              [
                'core/heading',
                'core/paragraph',
                'core/button',
              ]
            }
          />
        </div>
      </div>
    );
  },

  // The save "render" function
  save(props) {
    let { image } = props.attributes;

    return (
      <li className="slider__slide">
        <img src={image.src} alt={image.alt} />

        <div className="slider__text">
          <InnerBlocks.Content />
        </div>
      </li>
    );
  }

});
