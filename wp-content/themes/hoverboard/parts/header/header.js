(() => {
	const changeClass = () => {
		if (window.scrollY <= 0) {
			document.body.classList.remove('js-scrolled');
		} else {
			document.body.classList.add('js-scrolled');
		}
	};

	const scroll = () => {
		requestAnimationFrame(() => {
			changeClass();
		});
	};

	changeClass();

	window.addEventListener('scroll', scroll);
})();
