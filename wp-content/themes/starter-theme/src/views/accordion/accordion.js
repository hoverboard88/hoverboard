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
  }
  /**
   * Assigns a class to the first item of the accordion.
   * @readonly
   * @memberof Accordion
   */
  get firstItem() {
    const first = this.element.getElementsByClassName('accordion__item')[0];
    first.classList.add('accordion__item--active');
  }
  /**
   * Get the closest element based on selector
   * @param {any} element base element to target from
   * @param {any} selector selector to target element to receive
   */
  getClosest(element, selector) {
    // Element.matches() polyfill
    if (!Element.prototype.matches) {
      Element.prototype.matches =
        Element.prototype.matchesSelector ||
        Element.prototype.mozMatchesSelector ||
        Element.prototype.msMatchesSelector ||
        Element.prototype.oMatchesSelector ||
        Element.prototype.webkitMatchesSelector ||
        function(s) {
          var matches = (this.document || this.ownerDocument).querySelectorAll(
              s
            ),
            i = matches.length;
          while (--i >= 0 && matches.item(i) !== this) {}
          return i > -1;
        };
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
    // const item = event.target.parentNode.parentNode;
    const item = this.getClosest(event.target, '.accordion__item');
    event.preventDefault();

    Array.from(this.element.children).map(items => {
      return items.classList.remove('accordion__item--active');
    });

    item.classList.toggle('accordion__item--active');
  }
  /**
   * Adds the click event listener to all buttons of the accordion.
   * @memberof Accordion
   */
  toggle() {
    const buttons = this.element.querySelectorAll('.accordion__button');

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
