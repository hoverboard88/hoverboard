import Glide, { Controls, Breakpoints } from '@glidejs/glide/dist/glide.modular.esm';

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

var Accordion = /*#__PURE__*/function () {
  function Accordion(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '{}';

    _classCallCheck(this, Accordion);

    this.element = element;
    this.options = JSON.parse(options);
    this.first = element.querySelectorAll('.js-accordion-item')[0];
    this.itemClass = this.first.classList[0];
    this.activeClass = "".concat(this.itemClass, "--active");
  }

  _createClass(Accordion, [{
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
  }, {
    key: "click",
    value: function click(event) {
      var _this = this;

      var item = this.getClosest(event.target, '.js-accordion-item');
      event.preventDefault();

      if (item.classList.contains(this.activeClass)) {
        return item.classList.remove(this.activeClass);
      }

      Array.from(this.element.children).map(function (items) {
        return items.classList.remove(_this.activeClass);
      });
      item.classList.toggle(this.activeClass);
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var _this2 = this;

      var buttons = this.element.querySelectorAll('.js-accordion-button');
      Array.from(buttons).map(function (button) {
        return button.addEventListener('click', _this2.click.bind(_this2));
      });
    }
  }, {
    key: "init",
    value: function init() {
      if (this.options.open) {
        this.firstItem;
      }

      this.toggle();
    }
  }, {
    key: "firstItem",
    get: function get() {
      this.first.classList.add(this.activeClass);
    }
  }]);

  return Accordion;
}();

var Header = /*#__PURE__*/function () {
  function Header(element) {
    _classCallCheck(this, Header);

    this.element = element;
  }

  _createClass(Header, [{
    key: "scroll",
    value: function scroll() {
      var bodyClasses = document.body.classList;
      window.scrollY > 0 ? bodyClasses.add('float-header--scrolled') : bodyClasses.remove('float-header--scrolled');
    }
  }, {
    key: "init",
    value: function init() {
      var _this = this;

      this.scroll();
      window.addEventListener('scroll', function () {
        setTimeout(function () {
          _this.scroll();
        }, 100);
      });
    }
  }]);

  return Header;
}();

var NavToggle = /*#__PURE__*/function () {
  function NavToggle(element) {
    _classCallCheck(this, NavToggle);

    this.element = element;
  }

  _createClass(NavToggle, [{
    key: "init",
    value: function init() {
      this.element.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('body').classList.toggle('js-body-nav-toggle');
      });
      document.querySelectorAll('.button-nav-toggle').forEach(function (button) {
        button.addEventListener('click', function (e) {
          e.preventDefault();
          document.querySelector('body').classList.toggle('js-body-nav-toggle');
        });
      });
    }
  }]);

  return NavToggle;
}();

var SearchToggle = /*#__PURE__*/function () {
  function SearchToggle(element) {
    _classCallCheck(this, SearchToggle);

    this.element = element;
  }

  _createClass(SearchToggle, [{
    key: "init",
    value: function init() {
      var _this = this;

      this.element.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector('body').classList.toggle('js-body-search-toggle');

        if (document.body.classList.contains('js-body-search-toggle')) {
          console.log(_this.element.querySelector('.search__input'));
          document.querySelector('.search__input').focus();
        }
      });
    }
  }]);

  return SearchToggle;
}();

var Slider = /*#__PURE__*/function () {
  function Slider(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '{}';

    _classCallCheck(this, Slider);

    this.element = element;
    this.options = JSON.parse(options);
    this.cssClass = this.element.classList[0];
  }

  _createClass(Slider, [{
    key: "init",
    value: function init() {
      return new Glide(this.element, {
        classes: {
          direction: {
            ltr: "".concat(this.cssClass, "--ltr"),
            rtl: "".concat(this.cssClass, "--rtl")
          },
          slider: "".concat(this.cssClass, "--slider"),
          carousel: "".concat(this.cssClass, "--carousel"),
          swipeable: "".concat(this.cssClass, "--swipeable"),
          dragging: "".concat(this.cssClass, "--dragging"),
          cloneSlide: "".concat(this.cssClass, "__slide--clone"),
          activeNav: "".concat(this.cssClass, "__bullet--active"),
          activeSlide: "".concat(this.cssClass, "__slide--active"),
          disabledArrow: "".concat(this.cssClass, "__arrow--disabled")
        }
      }).mount({
        Controls: Controls,
        Breakpoints: Breakpoints
      });
    }
  }]);

  return Slider;
}();

var hb = {
  Accordion: Accordion,
  Header: Header,
  NavToggle: NavToggle,
  SearchToggle: SearchToggle,
  Slider: Slider,
  getModules: function getModules() {
    return Array.from(document.querySelectorAll('[data-init-js]'));
  },
  loadModules: function loadModules(element) {
    var className = element.dataset.initJs;
    var options = element.dataset.optionsJs;
    return new this[className](element, options).init();
  },
  init: function init() {
    this.getModules().map(this.loadModules);
  }
};
hb.init();
