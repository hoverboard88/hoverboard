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
    this.animations = document.querySelectorAll('[data-animation]');
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
  animateIn(element, animationName, animationDuration) {
    element.classList.add('animated', animationName, animationDuration);
  }

  /**
   * Animate Out elements
   * @memberof Animation
   */
  animateOut(element, animationName, animationDuration) {
    element.classList.remove('animated', animationName, animationDuration);
  }

  /**
   * Animate
   * @memberof Animation
   */
  animate(animations) {
    Array.from(animations).map(animation => {
      const animationName = animation.dataset.animation;
      const animationDuration = animation.dataset.animationDuration;

      if (this.isInViewport(animation)) {
        this.animateIn(animation, animationName, animationDuration);
      } else {
        this.animateOut(animation, animationName, animationDuration);
      }
    });
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
