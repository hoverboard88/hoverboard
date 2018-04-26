import Glide from '@glidejs/glide';
import {Controls, Breakpoints} from '@glidejs/glide/dist/glide.modular.esm';

/**
 * Lightbox
 * @class Lightbox
 */
class Slider {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   * @memberof Slider
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
  }
  /**
   * Initialize.
   */
  init() {
    return new Glide(this.element, {
      type: 'carosel',
    }).mount({Controls, Breakpoints});
  }
}

export default Slider;
