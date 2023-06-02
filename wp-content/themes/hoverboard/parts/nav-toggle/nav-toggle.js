(() => {
	const toggle = (event) => {
		event.preventDefault();
		document.querySelector('body').classList.toggle('js-body-nav-toggle');
	};

	Array.from(document.querySelectorAll('.nav-toggle')).map((element) => {
		element.addEventListener('click', toggle);
	});
})();
