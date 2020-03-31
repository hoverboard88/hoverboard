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

/**
 * Animate
 * @class Animate
 */
var Animate =
/*#__PURE__*/
function () {
  /**
   * Creates an instance of Animate.
   * @memberof Animate
   */
  function Animate() {
    _classCallCheck(this, Animate);

    this.animateElements = document.querySelectorAll('[data-animate]');
  }
  /**
   * Is In Viewpoint
   * @memberof Animate
   */


  _createClass(Animate, [{
    key: "isInViewport",
    value: function isInViewport(element) {
      var elementTop = element.offsetTop;
      var elementBottom = elementTop + element.offsetHeight;
      var viewportTop = window.scrollY;
      var viewportBottom = viewportTop + window.innerHeight;
      return elementBottom > viewportTop && elementTop < viewportBottom;
    }
    /**
     * Animate in elements
     * @memberof Animate
     */

  }, {
    key: "animateIn",
    value: function animateIn(element) {
      element.classList.add('animated', element.getAttribute('data-animate'));
    }
    /**
     * Animate Out elements
     * @memberof Animate
     */

  }, {
    key: "animateOut",
    value: function animateOut(element) {
      element.classList.remove('animated', element.getAttribute('data-animate'));
    }
    /**
     * Animate
     * @memberof Animate
     */

  }, {
    key: "animate",
    value: function animate(elements) {
      var _this = this;

      Array.from(elements).forEach(function (element) {
        if (_this.isInViewport(element)) {
          _this.animateIn(element);
        } else {
          _this.animateOut(element);
        }
      });
    }
    /**
     * Initialize.
     */

  }, {
    key: "init",
    value: function init() {
      var _this2 = this;

      this.animate(this.animateElements);
      window.addEventListener('scroll', function () {
        _this2.animate(_this2.animateElements);
      });
    }
  }]);

  return Animate;
}();

new Animate().init();
