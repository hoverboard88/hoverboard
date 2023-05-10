(() => {
	const hbAccordions = document.querySelectorAll('[data-block="accordion"]');

	for (const accordion of hbAccordions) {
		const options = JSON.parse(accordion.dataset.options);

		if (options.open) {
			accordion
				.querySelector('.js-accordion-item')
				.classList.add('accordion__item--active');
		}

		accordion.addEventListener('click', hbAccordionToggle);
	}

	function hbAccordionToggle(event) {
		event.preventDefault();
		const subTitle = event.target;

		const items = subTitle
			.closest('.accordion')
			.querySelectorAll('.js-accordion-item');

		Array.from(items).map((item) =>
			item.classList.remove('accordion__item--active')
		);

		subTitle
			.closest('.js-accordion-item')
			.classList.toggle('accordion__item--active');
	}
})();
