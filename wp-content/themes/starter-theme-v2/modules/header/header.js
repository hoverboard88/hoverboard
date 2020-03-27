/**
 * Header
 * @class Header
 */
class Header {
	/**
	 * Creates an instance of Accordion.
	 * @param {any} element HTML element of the accordion
	 * @memberof Header
	 */
	constructor(element) {
		this.element = element;
	}

	scroll() {
		const bodyClasses = document.body.classList;

		window.scrollY > 0
			? bodyClasses.add('float-header--scrolled')
			: bodyClasses.remove('float-header--scrolled');
	}

	/**
	 * Initialize.
	 */
	init() {
		this.scroll();

		window.addEventListener('scroll', () => {
			setTimeout(() => {
				this.scroll();
			}, 100);
		});
	}
}

export {Header};
