(() => {
	const toggle = (event) => {
		event.preventDefault();
		document.querySelector('body').classList.toggle('js-body-search-toggle');

		if (document.body.classList.contains('js-body-search-toggle')) {
			document.querySelector('.search-form__input').focus();
		}
	};

	const initialize = (searchToggle) => {
		const element = searchToggle.element;
		const options = JSON.parse(searchToggle.options);

		element.addEventListener('click', toggle);
	};

	const searchToggle = hb.setup('search-toggle');

	searchToggle.map(initialize);
})();
