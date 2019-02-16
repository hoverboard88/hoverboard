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
    let attrs = props.attributes;

    return ([
      props.isSelected && (<InspectorControls>
        <p>
          <MediaUpload
            type="image"
            onSelect={(image) => {
              props.setAttributes({
                imageUrl: image.sizes.hero.url,
                imageHeight: image.sizes.hero.height,
                imageWidth: image.sizes.hero.width,
              });
            }}
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
            value={attrs.overlayColor}
            onChange={(overlayColor) => props.setAttributes({ overlayColor })}
          />
        </p>

        <p>
          <RangeControl
            label="Overlay Opacity %"
            value={attrs.overlayOpacity}
            onChange={(overlayOpacity) => props.setAttributes({ overlayOpacity })}
            min={0}
            max={100}
          />
        </p>

      </InspectorControls>),
      <div className={`hero align${attrs.alignment}`} style={{ backgroundImage: `url(${attrs.imageUrl})` }}>
        <div
          className={`hero__overlay`}
          style={{
            background: attrs.overlayColor,
            opacity: `${attrs.overlayOpacity / 100}`,
          }}
        ></div>
        <RichText
          tagName="h1"
          value={attrs.content}
          onChange={(updatedContent) => { props.setAttributes({ content: updatedContent }) }}
          isSelected={props.isSelected}
          className={`hero__title`}
        />
      </div>
    ]);
  },

  // The save "render" function
  save(props) {
    let attrs = props.attributes;

    return (
      <div className={`hero align${attrs.alignment}`} style={{
        backgroundImage: `url(${attrs.imageUrl})`,
        height: `${attrs.imageHeight / attrs.imageWidth * 100}vw`
      }}>
        <div
          className={`hero__overlay`}
          style={{
            background: attrs.overlayColor,
            opacity: `${attrs.overlayOpacity / 100}`,
          }}
        ></div>
        <h1
          className={`hero__title`}
        >
          {attrs.content}
        </h1>
      </div>
    );
  }

});
