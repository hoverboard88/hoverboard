/**
 * Nav Toggle
 * @class NavToggle
 */
class NavToggle {
	/**
	 * Creates an instance of Accordion.
	 * @param {any} element HTML element of the accordion
	 * @memberof NavToggle
	 */
	constructor(element) {
		this.element = element;
	}

	/**
	 * Initialize.
	 */
	init() {
		this.element.addEventListener('click', e => {
			e.preventDefault();
			document.querySelector('body').classList.toggle('js-body-nav-toggle');
		});

		document.querySelectorAll('.button-nav-toggle').forEach(button => {
			button.addEventListener('click', e => {
				e.preventDefault();
				document.querySelector('body').classList.toggle('js-body-nav-toggle');
			});
		});
	}
}

export {NavToggle};
