const { registerBlockType } = wp.blocks;

const {
  RichText,
  InspectorControls, // allows us to add controls on the sidebar
  BlockControls, //component that appears right above block when it is selected
  BlockAlignmentToolbar, //prebuild alignment button component that we put in block controls for this block
  MediaUpload, // allows us to upload images
  ColorPalette, // prebuilt component that allows color picking in inspector controls
} = wp.editor;

registerBlockType('starter-theme/hero', {
  title: 'Hero',
  icon: 'format-image',
  category: 'common',
  attributes: {
    content: {
      type: 'array',
      source: 'children',
      selector: 'h1',
      default: 'Editable block content…',
    },
    imageUrl: {
      type: 'string',
      default: "http://placehold.it/1400x600"
    },
    align: {
      type: 'string',
      default: 'full'
    },
    imageWidth: {
      type: 'string',
      default: "1400"
    },
    imageHeight: {
      type: 'string',
      default: "600"
    },
    textColor: {
      type: 'string',
      default: null
    },
    overlayColor: {
      type: 'string',
      default: null
    }
  },

  // The editor "render" function
  edit(props) {
    let { alignment, content, imageUrl, textColor, overlayColor } = props.attributes;

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
    function onChangeOverlayColor(color) {
      props.setAttributes({ overlayColor: color });
    }
    function onChangeTextColor(color) {
      props.setAttributes({ textColor: color });
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

        <p>Select text color:</p>

        <p>
          <ColorPalette
            value={textColor}
            onChange={onChangeTextColor}
          />
        </p>

        <p>
          <span>Select a gradient color:</span>
          <ColorPalette
            value={overlayColor}
            onChange={onChangeOverlayColor}
          />
        </p>

      </InspectorControls>),
      props.isSelected && (
        <BlockControls>
          <BlockAlignmentToolbar
            value={alignment}
            onChange={(change) => props.setAttributes({ alignment: change, align: change, })}
          />
        </BlockControls>
      ),
      <div className={`hero hero--align- align${alignment}`} style={{ backgroundImage: `url(${imageUrl})` }}>
        <div
          className={`hero__overlay`}
          style={{
            background: overlayColor,
            opacity: '.3'
          }}
        ></div>
        <RichText
          tagName="h1"
          value={content}
          onChange={onChangeContent}
          isSelected={props.isSelected}
          className={`hero__title`}
          style={{
            color: textColor,
          }}
        />
      </div>
    ]);
  },

  // The save "render" function
  save(props) {
    let { className } = props;
    let { alignment, content, imageUrl, imageHeight, imageWidth, overlayColor, textColor } = props.attributes;

    return (
      <div className={`hero hero--align-${alignment} align${alignment}`} style={{
        backgroundImage: `url(${imageUrl})`,
        height: `${imageHeight / imageWidth * 100}vw`
      }}>
        <div
          className={`hero__overlay`}
          style={{
            background: overlayColor,
            opacity: '.3'
          }}
        ></div>
        <h1
          className={`hero__title`}
          style={{ color: textColor }}
        >
          {content}
        </h1>
      </div>
    );
  }

});
