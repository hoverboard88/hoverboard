/**
 * Lightbox
 * @class Lightbox
 */
class Lightbox {
	/**
	 * Creates an instance of Accordion.
	 * @param {any} element HTML element of the accordion
	 * @param {string} [options='{}'] Options provided by data-options-js data attribute
	 * @memberof Lightbox
	 */
	constructor(element, options = '{}') {
		this.element = element;
		this.options = JSON.parse(options);
		this.id = this.element.getAttribute('id');
	}
	/**
	 * Close Lightbox
	 * @param {*} event
	 */
	close(event) {
		event.preventDefault();
		document.querySelector('body').classList.remove('lightbox-active');
	}
	/**
	 * Open Lightbox
	 * @param {any} event
	 * @memberof Lightbox
	 */
	open(event) {
		event.preventDefault();
		document.querySelector('body').classList.add('lightbox-active');
	}
	/**
	 * Don't bubble click event from overlay element
	 * @param {any} event
	 * @memberof Lightbox
	 */
	stopPropagation(event) {
		event.stopPropagation();
	}
	/**
	 * Initialize.
	 */
	init() {
		const button = document.querySelector(`[href="#${this.id}"]`);
		const close = this.element.querySelector('.lightbox__close');
		const overlay = this.element.querySelector('.lightbox__overlay');
		const popup = this.element.querySelector('.lightbox__popup');

		if (button) {
			button.addEventListener('click', this.open);
		}
		close.addEventListener('click', this.close);
		overlay.addEventListener('click', this.close);
		popup.addEventListener('click', this.stopPropagation);
	}
}

export {Lightbox};
