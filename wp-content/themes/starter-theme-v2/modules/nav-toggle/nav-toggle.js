export class NavToggle {
	constructor(element) {
		this.element = element;
	}
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
