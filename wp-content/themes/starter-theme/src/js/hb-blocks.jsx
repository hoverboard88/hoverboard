// This was taken mostly from: https://github.com/rtCamp/gutenberg-fields-middleware/blob/develop/middleware/components/button-editable/index.js
const { Component } = wp.element;
const { RichText } = wp.editor;
const { Dashicon, IconButton } = wp.components;
const { __ } = wp.i18n;

class Hello extends Component {
  constructor() {
    super(...arguments);
  }

  render() {
    return (
      <div>Hello World</div>
    );
  }
}

export default {
  Hello,
};
