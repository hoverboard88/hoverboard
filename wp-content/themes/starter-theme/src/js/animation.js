/**
 * Animation
 * @class Animation
 */
class Animation {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @memberof Animation
   */
  constructor() {
    this.animations = document.querySelectorAll('[data-animate-js]');
    // this.animation = this.element.querySelector('.animation__items');
  }

  /**
   * Is In Viewpoint
   * @memberof Animation
   */
  isInViewport(element) {
    const elementTop = element.offsetTop;
    const elementBottom = elementTop + element.offsetHeight;
    const viewportTop = window.scrollY;
    const viewportBottom = viewportTop + window.innerHeight;

    return elementBottom > viewportTop && elementTop < viewportBottom;
  }

  /**
   * Animate in elements stepped
   * @memberof Animation
   */
  animateIn(element) {
    element.classList.add('animated');
  }
  /**
   * Animate in elements stepped
   * @memberof Animation
   */
  // animateStepIn(element) {
  //   var maxLoops = element.querySelectorAll('.animation__item').length - 1;
  //   var counter = 0;

  //   (function next() {
  //     if (counter++ > maxLoops) return;

  //     setTimeout(function() {
  //       element
  //         .querySelector(`.animation__item:nth-child(${counter})`)
  //         .classList.add('animated');

  //       next();
  //     }, 250);
  //   })();
  // }

  /**
   * Animate
   * @memberof Animation
   */
  animate(animations) {
    Array.from(animations).map(animation => {
      if (this.isInViewport(animation)) {
        this.animateIn(animation);
      } else {
        this.animateOut(animation);
      }
    });
  }

  /**
   * Animate Out elements
   * @memberof Animation
   */
  animateOut(element) {
    element.classList.remove('animated');
  }

  /**
   * Initialize.
   */
  init() {
    this.animate(this.animations);

    window.addEventListener('scroll', () => {
      this.animate(this.animations);
    });
  }
}

export default Animation;
