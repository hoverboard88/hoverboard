const { registerBlockType } = wp.blocks;
const { PanelBody, PanelRow, RadioControl } = wp.components;
const { InnerBlocks, InspectorControls } = wp.editor;

registerBlockType('starter-theme/accordion', {
  title: 'Accordion',
  category: 'common',
  icon: 'list-view',
  attributes: {
    options: {
      default: [
        { label: 'Open one panel at a time', value: 'single' },
        { label: 'Open multiple panels', value: 'multiple' },
      ],
      type: 'array',
    },
    selected: {
      default: 'single',
      type: 'string',
    }
  },
  edit(props) {
    const options = props.attributes.options;
    const selected = props.attributes.selected;

    return ([
      <InspectorControls>
        <PanelBody
          title="Settings"
          initialOpen={ true }
        >
          <PanelRow>
            <RadioControl
              label="Accordion Options"
              selected={ selected }
              options={ options }
              onChange={ (selected) => { props.setAttributes({ selected }) } }
            />
          </PanelRow>
        </PanelBody>
      </InspectorControls>,
      <div style={{ padding: '15px' }}>
        <InnerBlocks
          template={[
            ['starter-theme/accordion-item']
          ]}
          allowedBlocks={
            ['starter-theme/accordion-item']
          }
        />
      </div>
    ]);
  },
  save(props) {
    const option = props.attributes.selected;

    return (
      <div className="accordion" data-block-init-js="accordion" data-option={ option }>
        <InnerBlocks.Content />
      </div>
    );
  },
});