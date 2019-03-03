const { registerBlockType } = wp.blocks;
const { PlainText, InnerBlocks } = wp.editor;

registerBlockType('starter-theme/accordion-item', {
  title: 'Accordion Item',
  parent: ['starter-theme/accordion'],
  category: 'common',
  icon: 'list-view',
  attributes: {
    heading: {
      default: 'Heading',
      type: 'string',
    }
  },
  edit(props) {

    return (
      <div className="accordion__item">
        <h3 className="accordion__heading">
          <PlainText
            className="accordion__textarea"
            onChange={ (heading) => { props.setAttributes({ heading }) } }
            value={ props.attributes.heading }
          />
        </h3>
        <div className="accordion__panel">
          <InnerBlocks
            template={[
              ['core/paragraph', {
                placeholder: 'Content',
              }]
            ]}
            allowedBlocks={[
              'core/heading',
              'core/paragraph',
              'core/button',
            ]}
          />
        </div>
      </div>
    );
  },
  save({ attributes }) {
    return (
      <div className="accordion__item" data-aria-accordion-item>
        <h3 className="accordion__heading accordion__heading--no-js" data-aria-accordion-heading>{ attributes.heading }</h3>
        <div className="accordion__panel accordion__panel--no-js" data-aria-accordion-panel>
          <InnerBlocks.Content />
        </div>
      </div>
    );
  },
});