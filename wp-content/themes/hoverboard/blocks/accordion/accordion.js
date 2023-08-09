(() => {
	const accordions = document.querySelectorAll('[data-block="accordion"]');
	Array.from(accordions).map((accordion) => init(accordion));

	function init(accordion) {
		const options = JSON.parse(accordion.dataset.options);
		if (options.open)
			accordion
				.querySelector('.js-accordion-item')
				.classList.add('wp-block-accordion__item--active');
		accordion.addEventListener('click', accordionToggle.bind(accordion));
	}

	function accordionToggle(event) {
		event.preventDefault();
		const accordionItems = this.querySelectorAll('.js-accordion-item');
		const activeAccordionItem = event.target.closest('.js-accordion-item');
		const isOpen = activeAccordionItem.classList.contains(
			'wp-block-accordion__item--active'
		);

		isOpen
			? closeAllAccordions(accordionItems)
			: (closeAllAccordions(accordionItems),
			  toggleAccordion(activeAccordionItem));
	}

	function closeAllAccordions(accordions) {
		return Array.from(accordions).map((accordion) =>
			accordion.classList.remove('wp-block-accordion__item--active')
		);
	}

	function toggleAccordion(accordion) {
		return accordion.classList.toggle('wp-block-accordion__item--active');
	}
})();
