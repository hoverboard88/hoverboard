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
   * @type {Object} NodeList of menu items with children based off classes Wordpress classes.
   */
  get parentMenuItems() {
    return this.element.querySelectorAll('.js-menu-item');
  }

  /**
   * @param {Event} event listen event on mouseenter.
   */
  open(event) {
    const firstChildLink = this.querySelector('a');

    if (firstChildLink) {
      this.classList.add('menu-is-open');
      firstChildLink.setAttribute('aria-expanded', 'true');
    }

    event.preventDefault();
  }

  /**
   * @param {Event} event listen event on mouseleave.
   */
  close(event) {
    const firstChildLink = this.querySelector('a');

    if (firstChildLink) {
      this.classList.remove('menu-is-open');
      firstChildLink.setAttribute('aria-expanded', 'false');
    }

    event.preventDefault();
  }

  /**
   * @param {Event} event listen event on click.
   */
  toggle(event) {
    const anchor = this.children[0];

    if (this.classList.contains('menu-is-open')) {
      anchor.setAttribute('aria-expanded', 'false');
      this.classList.remove('menu-is-open');
    } else {
      const openMenus = document.querySelectorAll('.menu-is-open');

      Array.from(openMenus).forEach(menu => {
        menu.classList.remove('menu-is-open');
        menu.children[0].setAttribute('aria-expanded', 'false');
      });

      anchor.setAttribute('aria-expanded', 'true');
      this.classList.add('menu-is-open');
    }

    event.preventDefault();
  }

  /**
   * Add Toggle buttons.
   */
  addToggleButtons() {
    Array.from(this.parentMenuItems).forEach((element, index) => {
      // TODO: Remove .header-link class dependancy
      const button = `<button class="header-link__toggle">
          <svg viewBox="0 0 24 24">
            <path fill="#000000" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,17L17,12H14V8H10V12H7L12,17Z" />
          </svg>
        </button>`;

      // TODO: Remove .header-link class dependancy
      element.classList.add('header-menu__item--toggle');
      element.innerHTML = element.innerHTML + button;

      element
        // TODO: Remove .header-link class dependancy
        .querySelector('.header-link__toggle')
        .addEventListener('click', this.toggle.bind(element));
    });
  }

  /**
   * a11y tabbing.
   */

  a11yTabbing() {
    Array.from(this.element.querySelectorAll('.js-menu-item a')).forEach(
      (element, index) => {
        element.addEventListener('blur', event => {
          const menuItemParent = this.getClosest(event.target, '.js-menu-item');

          menuItemParent.classList.remove('menu-is-open');
          menuItemParent.setAttribute('aria-expanded', 'false');
        });
        // TODO: Doesn't shift+tab correctly.
        element.addEventListener('focus', event => {
          // go to `.js-menu-item` and remove `.menu-is-open`
          const menuItemParent = this.getClosest(event.target, '.js-menu-item');

          menuItemParent.classList.add('menu-is-open');
          menuItemParent.setAttribute('aria-expanded', 'true');
        });
      }
    );
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
   * Initialize.
   */
  init() {
    if (this.options.toggle) {
      this.addToggleButtons();
    } else {
      Array.from(this.parentMenuItems).forEach((element, index) => {
        element.addEventListener('mouseenter', this.open);
        element.addEventListener('mouseleave', this.close);
      });
      this.a11yTabbing();
    }
  }
}

export default MenuFlyout;