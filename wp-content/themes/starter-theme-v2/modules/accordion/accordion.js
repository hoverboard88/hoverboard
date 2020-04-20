(($) => {
	const toggle = (event) => {
		event.preventDefault();

		const accordionItems = event.target
			.closest('.accordion')
			.querySelectorAll('.js-accordion-item');

		Array.from(accordionItems).map((accordionItem) =>
			accordionItem.classList.remove('accordion__item--active')
		);

		event.target
			.closest('.js-accordion-item')
			.classList.toggle('accordion__item--active');
	};

	const initialize = (accordion) => {
		const element = accordion.element;
		const options = JSON.parse(accordion.options);

		if (options.open) {
			element
				.querySelector('.js-accordion-item')
				.classList.add('accordion__item--active');
		}

		element.addEventListener('click', toggle);
	};

	const accordion = hb.setup('accordion');

	accordion.map(initialize);
})(jQuery);
