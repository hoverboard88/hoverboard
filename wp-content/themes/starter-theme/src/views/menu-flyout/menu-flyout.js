/**
 * Menu Flyout
 * @class MenuFlyout
 */
class MenuFlyout {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   * @memberof MenuFlyout
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
  }
  /**
   * Initialize.
   */
  init() {}
}

export default MenuFlyout;
