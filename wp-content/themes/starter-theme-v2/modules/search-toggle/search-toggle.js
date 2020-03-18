/**
 * Search Toggle
 * @class SearchToggle
 */
class SearchToggle {
	/**
	 * Creates an instance of Accordion.
	 * @param {any} element HTML element of the accordion
	 * @memberof SearchToggle
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

			document.querySelector('body').classList.toggle('js-body-search-toggle');

			if (document.body.classList.contains('js-body-search-toggle')) {
				console.log(this.element.querySelector('.search__input'));

				document.querySelector('.search__input').focus();
			}
		});
	}
}

export default SearchToggle;
