function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  return Constructor;
}

var MenuMobile =
/*#__PURE__*/
function () {
  function MenuMobile(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '{}';

    _classCallCheck(this, MenuMobile);

    this.element = element;
    this.options = JSON.parse(options); // this.toggles = document.querySelectorAll('[data-mobile-menu-toggle]');
  }

  _createClass(MenuMobile, [{
    key: "init",
    value: function init() {
      console.log('menu...');
    }
  }]);

  return MenuMobile;
}();

/**
 * Menu Flyout
 * @class MenuFlyout
 */
var MenuFlyout =
/*#__PURE__*/
function () {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   */
  function MenuFlyout(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '{}';

    _classCallCheck(this, MenuFlyout);

    this.element = element;
    this.options = JSON.parse(options);
  }
  /**
   * @type {Object} NodeList of menu items with children based off classes Wordpress classes.
   */


  _createClass(MenuFlyout, [{
    key: "open",

    /**
     * @param {Event} event listen event on mouseenter.
     */
    value: function open(event) {
      var firstChildLink = this.querySelector('a');

      if (firstChildLink) {
        this.classList.add('menu-is-open');
        firstChildLink.setAttribute('aria-expanded', 'true');
      }

      event.preventDefault();
    }
    /**
     * @param {Event} event listen event on mouseleave.
     */

  }, {
    key: "close",
    value: function close(event) {
      var firstChildLink = this.querySelector('a');

      if (firstChildLink) {
        this.classList.remove('menu-is-open');
        firstChildLink.setAttribute('aria-expanded', 'false');
      }

      event.preventDefault();
    }
    /**
     * @param {Event} event listen event on click.
     */

  }, {
    key: "toggle",
    value: function toggle(event) {
      var anchor = this.children[0];

      if (this.classList.contains('menu-is-open')) {
        anchor.setAttribute('aria-expanded', 'false');
        this.classList.remove('menu-is-open');
      } else {
        var openMenus = document.querySelectorAll('.menu-is-open');
        Array.from(openMenus).forEach(function (menu) {
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

  }, {
    key: "addToggleButtons",
    value: function addToggleButtons() {
      var _this = this;

      Array.from(this.parentMenuItems).forEach(function (element, index) {
        // TODO: Remove .header-link class dependancy
        var button = "<button class=\"header-link__toggle\">\n          <svg viewBox=\"0 0 24 24\">\n            <path fill=\"#000000\" d=\"M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,17L17,12H14V8H10V12H7L12,17Z\" />\n          </svg>\n        </button>"; // TODO: Remove .header-link class dependancy

        element.classList.add('header-menu__item--toggle');
        element.innerHTML = element.innerHTML + button;
        element // TODO: Remove .header-link class dependancy
        .querySelector('.header-link__toggle').addEventListener('click', _this.toggle.bind(element));
      });
    }
    /**
     * a11y tabbing.
     */

  }, {
    key: "a11yTabbing",
    value: function a11yTabbing() {
      var _this2 = this;

      Array.from(this.element.querySelectorAll('.js-menu-item a')).forEach(function (element, index) {
        element.addEventListener('blur', function (event) {
          var menuItemParent = _this2.getClosest(event.target, '.js-menu-item');

          menuItemParent.classList.remove('menu-is-open');
          menuItemParent.setAttribute('aria-expanded', 'false');
        }); // TODO: Doesn't shift+tab correctly.

        element.addEventListener('focus', function (event) {
          // go to `.js-menu-item` and remove `.menu-is-open`
          var menuItemParent = _this2.getClosest(event.target, '.js-menu-item');

          menuItemParent.classList.add('menu-is-open');
          menuItemParent.setAttribute('aria-expanded', 'true');
        });
      });
    }
    /**
     * Get the closest element based on selector
     * @param {any} element base element to target from
     * @param {any} selector selector to target element to receive
     */

  }, {
    key: "getClosest",
    value: function getClosest(element, selector) {
      // Element.matches() polyfill
      if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector;
      } // Get the closest matching element


      for (; element && element !== document; element = element.parentNode) {
        if (element.matches(selector)) return element;
      }

      return null;
    }
    /**
     * Initialize.
     */

  }, {
    key: "init",
    value: function init() {
      var _this3 = this;

      if (this.options.toggle) {
        this.addToggleButtons();
      } else {
        Array.from(this.parentMenuItems).forEach(function (element, index) {
          element.addEventListener('mouseenter', _this3.open);
          element.addEventListener('mouseleave', _this3.close);
        });
        this.a11yTabbing();
      }
    }
  }, {
    key: "parentMenuItems",
    get: function get() {
      return this.element.querySelectorAll('.js-menu-item');
    }
  }]);

  return MenuFlyout;
}();

export { MenuMobile, MenuFlyout as navigationFlyout };
