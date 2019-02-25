const { registerBlockType } = wp.blocks;

const {
  RichText,
  InspectorControls,
} = wp.editor;

registerBlockType('starter-theme/BLOCK_NAME', {
  title: 'BLOCK_TITLE',
  // Uses https://developer.wordpress.org/resource/dashicons/
  icon: 'format-image',
  category: 'common',
  supports: {
    align: ['wide', 'full'],
  },
  attributes: {
    title: {
      type: 'array',
      source: 'children',
      selector: 'h1',
      default: 'Editable block content…',
    },
  },

  // The editor "render" function
  edit(props) {
    let attrs = props.attributes;

    return ([
      props.isSelected && (<InspectorControls>
        {/* Side column settings */}
      </InspectorControls>),
      <div className={`BLOCK_NAME align${attrs.alignment}`}>
        <RichText
          tagName="h3"
          value={attrs.title}
          onChange={(updatedContent) => { props.setAttributes({ content: updatedContent }) }}
          isSelected={props.isSelected}
          className={`BLOCK_NAME`}
        />
      </div>
    ]);
  },

  // The save "render" function
  save(props) {
    let attrs = props.attributes;

    return (
      <div className={`BLOCK_NAME align${attrs.alignment}`}>
        <h3
          className={`BLOCK_NAME`}
        >
          {attrs.title}
        </h3>
      </div>
    );
  }

});
