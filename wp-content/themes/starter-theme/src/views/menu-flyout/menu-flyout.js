/**
 * Menu Flyout
 * @class MenuFlyout
 */
class MenuFlyout {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
  }
  /**
   * @type {Object} NodeList of menu items with children.
   */
  get menuItems() {
    return this.element.querySelectorAll('.menu-item-has-children');
  }
  /**
   * @param {Event} event listen event on mouseenter.
   */
  open(event) {
    const firstChildLink = this.querySelector('.header-menu__link');
    if (firstChildLink) {
      this.classList.add('menu-item-is-open');
      firstChildLink.setAttribute('aria-expanded', 'true');
    }
    event.preventDefault();
    return false;
  }
  /**
   * @param {Event} event listen event on mouseleave.
   */
  close(event) {
    const firstChildLink = this.querySelector('.header-menu__link');
    if (firstChildLink) {
      this.classList.remove('menu-item-is-open');
      firstChildLink.setAttribute('aria-expanded', 'false');
    }
    event.preventDefault();
    return false;
  }
  /**
   * Initialize.
   */
  init() {
    this.menuItems.forEach((element, index) => {
      element.addEventListener('mouseenter', this.open);
      element.addEventListener('mouseleave', this.close);
    });
  }
}

export default MenuFlyout;
