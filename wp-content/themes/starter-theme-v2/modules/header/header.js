export class Header {
	constructor(element) {
		this.element = element;
	}
	scroll() {
		const bodyClasses = document.body.classList;

		window.scrollY > 0
			? bodyClasses.add('float-header--scrolled')
			: bodyClasses.remove('float-header--scrolled');
	}
	init() {
		this.scroll();

		window.addEventListener('scroll', () => {
			setTimeout(() => {
				this.scroll();
			}, 100);
		});
	}
}
