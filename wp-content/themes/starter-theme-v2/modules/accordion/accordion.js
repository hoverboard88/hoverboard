export class Accordion {
	constructor(element, options = '{}') {
		this.element = element;
		this.options = JSON.parse(options);
		this.first = element.querySelectorAll('.js-accordion-item')[0];
		this.itemClass = this.first.classList[0];
		this.activeClass = `${this.itemClass}--active`;
	}
	get firstItem() {
		this.first.classList.add(this.activeClass);
	}
	getClosest(element, selector) {
		// Element.matches() polyfill
		if (!Element.prototype.matches) {
			Element.prototype.matches = Element.prototype.msMatchesSelector;
		}

		// Get the closest matching element
		for (; element && element !== document; element = element.parentNode) {
			if (element.matches(selector)) return element;
		}
		return null;
	}
	click(event) {
		const item = this.getClosest(event.target, '.js-accordion-item');
		event.preventDefault();

		if (item.classList.contains(this.activeClass)) {
			return item.classList.remove(this.activeClass);
		}

		Array.from(this.element.children).map((items) => {
			return items.classList.remove(this.activeClass);
		});

		item.classList.toggle(this.activeClass);
	}
	toggle() {
		const buttons = this.element.querySelectorAll('.js-accordion-button');

		Array.from(buttons).map((button) => {
			return button.addEventListener('click', this.click.bind(this));
		});
	}
	init() {
		if (this.options.open) {
			this.firstItem;
		}

		this.toggle();
	}
}
