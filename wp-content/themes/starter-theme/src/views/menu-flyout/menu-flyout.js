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
    return this.element.querySelectorAll('.js-menu-item-parent');
  }

  /**
   * @param {Event} event listen event on mouseenter.
   */
  open(event) {
    const firstChildLink = this.querySelector('a');

    if (firstChildLink) {
      this.classList.add('menu-item-is-open');
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
      this.classList.remove('menu-item-is-open');
      firstChildLink.setAttribute('aria-expanded', 'false');
    }

    event.preventDefault();
  }

  /**
   * @param {Event} event listen event on click.
   */
  toggle(event) {
    const anchor = this.children[0];

    if (this.classList.contains('menu-item-is-open')) {
      anchor.setAttribute('aria-expanded', 'false');
      this.classList.remove('menu-item-is-open');
    } else {
      const openMenus = document.querySelectorAll('.menu-item-is-open');

      Array.from(openMenus).forEach(menu => {
        menu.classList.remove('menu-item-is-open');
        menu.children[0].setAttribute('aria-expanded', 'false');
      });

      anchor.setAttribute('aria-expanded', 'true');
      this.classList.add('menu-item-is-open');
    }

    event.preventDefault();
  }

  /**
   * Add Toggle buttons.
   */
  addToggleButtons() {
    Array.from(this.parentMenuItems).forEach((element, index) => {
      const firstChildLink = element.querySelector('a');
      const button = `<button class="header-link__toggle">
          <svg viewBox="0 0 24 24">
            <path fill="#000000" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,17L17,12H14V8H10V12H7L12,17Z" />
          </svg>
        </button>`;

      if (firstChildLink) {
        element.classList.add('header-menu__item--toggle');
        firstChildLink.innerHTML = firstChildLink.innerHTML + button;

        element
          .querySelector('.header-link__toggle')
          .addEventListener('click', this.toggle.bind(element));
      }
    });
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
    }
  }
}

export default MenuFlyout;
