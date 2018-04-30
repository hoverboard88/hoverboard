/**
 * Mobile Menu
 * @class MobileMenu
 */
class MobileMenu {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   * @memberof MobileMenu
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
    this.toggles = document.querySelectorAll('[data-mobile-menu-toggle]');
  }
  /**
   * Click will add active class to body tag.
   * @param {*} event A click event
   */
  click(event) {
    event.preventDefault();
    document.querySelector('body').classList.toggle('js-mobile-menu-active');
  }
  /**
   * Toggle's the event listeners.
   * @memberof MobileMenu
   */
  toggle() {
    // Some are outside of module, so won't be scoped to this.element
    this.toggles.forEach(toggle => {
      toggle.addEventListener('click', this.click);
    });
  }
  /**
   * Initialize.
   */
  init() {
    this.toggle();
  }
}

export default MobileMenu;
