(() => {
	const accordions = document.querySelectorAll('[data-block="accordion"]');

	for (const accordion of accordions) {
		const options = JSON.parse(accordion.dataset.options);

		if (options.open) {
			accordion
				.querySelector('.js-accordion-item')
				.classList.add('wp-block-accordion__item--active');
		}

		accordion.addEventListener('click', accordionToggle);
	}

	function accordionToggle(event) {
		event.preventDefault();
		const subTitle = event.target;

		const items = subTitle
			.closest('.wp-block-accordion')
			.querySelectorAll('.js-accordion-item');

		Array.from(items).map((item) =>
			item.classList.remove('wp-block-accordion__item--active')
		);

		subTitle
			.closest('.js-accordion-item')
			.classList.toggle('wp-block-accordion__item--active');
	}
})();
