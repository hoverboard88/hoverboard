const { registerBlockType } = wp.blocks;

const {
  RichText,
  InspectorControls,
} = wp.editor;

registerBlockType('starter-theme/BOILERPLATE', {
  title: 'BOILERPLATE_BLOCK',
  icon: 'format-image',
  category: 'common',
  supports: {
    align: ['wide', 'full'],
  },
  attributes: {
    content: {
      type: 'array',
      source: 'children',
      selector: 'h3',
      default: 'Editable block content…',
    },
    alignment: {
      type: 'string',
      default: 'full',
  },

  // The editor "render" function
  edit(props) {
    let attrs = props.attributes;

    return ([
      props.isSelected && (<InspectorControls>
        {/* Side column settings */}
      </InspectorControls>),
      <div className={`BOILERPLATE align${attrs.alignment}`}>
        <RichText
          tagName="h3"
          value={attrs.content}
          onChange={(updatedContent) => { props.setAttributes({ content: updatedContent }) }}
          isSelected={props.isSelected}
          className={`BOILERPLATE__title`}
        />
      </div>
    ]);
  },

  // The save "render" function
  save(props) {
    let attrs = props.attributes;

    return (
      <div className={`BOILERPLATE align${attrs.alignment}`}>
        <h3
          className={`BOILERPLATE__title`}
        >
          {attrs.content}
        </h3>
      </div>
    );
  }

});
