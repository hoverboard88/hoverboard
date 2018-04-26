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
   * OnClick will toggle the active classes.
   * @param {*} event Click event
   */
  click(event) {
    const item = event.target.parentNode.parentNode;
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
