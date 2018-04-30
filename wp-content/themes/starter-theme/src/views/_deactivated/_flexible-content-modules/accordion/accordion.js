import {Z_DEFAULT_COMPRESSION} from 'zlib';

/**
 * Simple Accordion
 * @class Accordion
 */
class Accordion {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   * @memberof Accordion
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
    this.first = element.querySelectorAll('[data-accordion-item]')[0];
    this.itemClass = this.first.getAttribute('class');
    this.activeClass = `${this.itemClass}--active`;
  }
  /**
   * Assigns a class to the first item of the accordion.
   * @readonly
   * @memberof Accordion
   */
  get firstItem() {
    this.first.classList.add(this.activeClass);
  }
  /**
   * Get the closest element based on selector
   * @param {any} element base element to target from
   * @param {any} selector selector to target element to receive
   */
  getClosest(element, selector) {
    // Element.matches() polyfill
    if (!Element.prototype.matches) {
      Element.prototype.matches = Element.prototype.msMatchesSelector;
    }

    // Get the closest matching element
    for (; element && element !== document; element = element.parentNode) {
      if (element.matches(selector)) return element;
    }
    return null;
  }
  /**
   * OnClick will toggle the active classes.
   * @param {*} event Click event
   */
  click(event) {
    const item = this.getClosest(event.target, '[data-accordion-item]');
    event.preventDefault();

    Array.from(this.element.children).map(items => {
      return items.classList.remove(this.activeClass);
    });

    item.classList.toggle(this.activeClass);
  }
  /**
   * Adds the click event listener to all buttons of the accordion.
   * @memberof Accordion
   */
  toggle() {
    const buttons = this.element.querySelectorAll('[data-accordion-button]');

    Array.from(buttons).map(button => {
      return button.addEventListener('click', this.click.bind(this));
    });
  }
  /**
   * Initialize.
   */
  init() {
    if (this.options.open) {
      this.firstItem;
    }

    this.toggle();
  }
}

export default Accordion;
