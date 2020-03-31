/**
 * Animate
 * @class Animate
 */
class Animate {
	/**
	 * Creates an instance of Animate.
	 * @memberof Animate
	 */
	constructor() {
		this.animateElements = document.querySelectorAll('[data-animate]');
	}

	/**
	 * Is In Viewpoint
	 * @memberof Animate
	 */
	isInViewport(element) {
		const elementTop = element.offsetTop;
		const elementBottom = elementTop + element.offsetHeight;
		const viewportTop = window.scrollY;
		const viewportBottom = viewportTop + window.innerHeight;

		return elementBottom > viewportTop && elementTop < viewportBottom;
	}

	/**
	 * Animate in elements
	 * @memberof Animate
	 */
	animateIn(element) {
		element.classList.add('animated', element.getAttribute('data-animate'));
	}

	/**
	 * Animate Out elements
	 * @memberof Animate
	 */
	animateOut(element) {
		element.classList.remove('animated', element.getAttribute('data-animate'));
	}

	/**
	 * Animate
	 * @memberof Animate
	 */
	animate(elements) {
		Array.from(elements).forEach((element) => {
			if (this.isInViewport(element)) {
				this.animateIn(element);
			} else {
				this.animateOut(element);
			}
		});
	}

	/**
	 * Initialize.
	 */
	init() {
		this.animate(this.animateElements);

		window.addEventListener('scroll', () => {
			this.animate(this.animateElements);
		});
	}
}
new Animate().init();
