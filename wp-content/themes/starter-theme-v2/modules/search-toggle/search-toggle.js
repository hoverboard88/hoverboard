export class SearchToggle {
	constructor(element) {
		this.element = element;
	}
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
