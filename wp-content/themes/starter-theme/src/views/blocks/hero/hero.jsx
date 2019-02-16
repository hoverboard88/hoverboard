const { registerBlockType } = wp.blocks;

const {
  RichText,
  InspectorControls, // allows us to add controls on the sidebar
  BlockControls, //component that appears right above block when it is selected
  MediaUpload, // allows us to upload images
  ColorPalette, // prebuilt component that allows color picking in inspector controls
} = wp.editor;

const {
  RangeControl,
  SelectControl,
} = wp.components;

registerBlockType('starter-theme/hero', {
  title: 'Hero',
  icon: 'format-image',
  category: 'common',
  // https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-registration/#supports-optional
  supports: {
    align: ['wide', 'full'],
  },
  attributes: {
    content: {
      type: 'array',
      source: 'children',
      selector: 'h1',
      default: 'Editable block content…',
    },
    imageUrl: {
      type: 'string',
      default: "https://placehold.it/1400x600"
    },
    alignment: {
      type: 'string',
      default: 'full',
    },
    imageWidth: {
      type: 'string',
      default: "1400"
    },
    imageHeight: {
      type: 'string',
      default: "600"
    },
    overlayColor: {
      type: 'string',
      default: null
    },
    overlayOpacity: {
      type: 'string',
      default: '30',
    },
  },

  // The editor "render" function
  edit(props) {
    let { alignment, content, imageUrl, textColor, overlayColor, overlayOpacity } = props.attributes;

    let alignment_class = `align${alignment}`;

    function onChangeContent(updatedContent) {
      props.setAttributes({ content: updatedContent });
    }

    function onChangeImage(imgObject) {
      props.setAttributes({
        imageUrl: imgObject.sizes.hero.url,
        imageHeight: imgObject.sizes.hero.height,
        imageWidth: imgObject.sizes.hero.width,
      });
    }

    function onChangeOverlayColor(overlayColor) {
      props.setAttributes({ overlayColor });
    }

    function onOverlayOpacity(overlayOpacity) {
      props.setAttributes({ overlayOpacity });
    }

    // Actual elements being
    return ([
      props.isSelected && (<InspectorControls>
        <p>
          <MediaUpload
            type="image"
            onSelect={onChangeImage}
            render={({ open }) => (
              <button onClick={open} className="button button-large">
                Select a background image
              </button>
            )}
          />
        </p>

        <p>Overlay Color</p>

        <p>
          <ColorPalette
            value={overlayColor}
            onChange={onChangeOverlayColor}
          />
        </p>

        <p>
          <RangeControl
            label="Overlay Opacity %"
            value={overlayOpacity}
            onChange={onOverlayOpacity}
            min={0}
            max={100}
          />
        </p>

      </InspectorControls>),
      <div className={`hero ${alignment_class}`} style={{ backgroundImage: `url(${imageUrl})` }}>
        <div
          className={`hero__overlay`}
          style={{
            background: overlayColor,
            opacity: `${overlayOpacity / 100}`,
          }}
        ></div>
        <RichText
          tagName="h1"
          value={content}
          onChange={onChangeContent}
          isSelected={props.isSelected}
          className={`hero__title`}
        />
      </div>
    ]);
  },

  // The save "render" function
  save(props) {
    let { alignment, content, imageUrl, imageHeight, imageWidth, overlayColor, overlayOpacity } = props.attributes;

    return (
      <div className={`hero align${alignment}`} style={{
        backgroundImage: `url(${imageUrl})`,
        height: `${imageHeight / imageWidth * 100}vw`
      }}>
        <div
          className={`hero__overlay`}
          style={{
            background: overlayColor,
            opacity: `${overlayOpacity / 100}`,
          }}
        ></div>
        <h1
          className={`hero__title`}
        >
          {content}
        </h1>
      </div>
    );
  }

});
