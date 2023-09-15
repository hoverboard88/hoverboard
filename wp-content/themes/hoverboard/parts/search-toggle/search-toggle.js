(() => {
	const toggle = (event) => {
		event.preventDefault();
		document.querySelector('body').classList.toggle('js-body-search-toggle');
		if (document.body.classList.contains('js-body-search-toggle')) {
			document.querySelector('.frontend-search-form__input').focus();
		}
	};

	Array.from(document.querySelectorAll('.search-toggle')).map((element) => {
		element.addEventListener('click', toggle);
	});
})();
