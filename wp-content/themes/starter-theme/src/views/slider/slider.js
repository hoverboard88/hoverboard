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
    this.cssClass = this.element.classList[0];
  }
  /**
   * Initialize.
   */
  init() {
    return new Glide(this.element, {
      type: 'carousel',
      classes: {
        direction: {
          ltr: `${this.cssClass}--ltr`,
          rtl: `${this.cssClass}--rtl`,
        },
        slider: `${this.cssClass}--slider`,
        carousel: `${this.cssClass}--carousel`,
        swipeable: `${this.cssClass}--swipeable`,
        dragging: `${this.cssClass}--dragging`,
        cloneSlide: `${this.cssClass}__slide--clone`,
        activeNav: `${this.cssClass}__bullet--active`,
        activeSlide: `${this.cssClass}__slide--active`,
        disabledArrow: `${this.cssClass}__arrow--disabled`,
      },
    }).mount({Controls, Breakpoints});
  }
}

export default Slider;
