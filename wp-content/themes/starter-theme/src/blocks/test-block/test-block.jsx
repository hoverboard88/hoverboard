const { __ } = wp.i18n;
const { RichText, MediaUpload, PlainText } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;

registerBlockType('starter-theme/test-block', {
  title: __('Test Block'),
  icon: 'admin-appearance',
  category: 'common',
  attributes: {
    title: {
      source: 'text',
      selector: '.card__title'
    },
    body: {
      type: 'array',
      source: 'children',
      selector: '.card__body'
    },
  },
  edit({ attributes, className, setAttributes }) {
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
    const { content } = attributes;

    return (
      <div className="card">
        <h3 className="card__title">
          {attributes.title}
        </h3>

        <div className="card__body">
          {attributes.body}
        </div>
      </div>
    );
  },
});
