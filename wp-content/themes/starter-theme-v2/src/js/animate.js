(($) => {
	const animate = (elements) => {
		Array.from(elements).forEach((element) => {
			if (isInViewport(element)) {
				animateIn(element);
			} else {
				animateOut(element);
			}
		});
	};
	const animateIn = (element) => {
		element.classList.add('animated', element.getAttribute('data-animate'));
	};
	const animateOut = (element) => {
		element.classList.remove('animated', element.getAttribute('data-animate'));
	};
	const isInViewport = (element) => {
		const elementTop = element.offsetTop;
		const elementBottom = elementTop + element.offsetHeight;
		const viewportTop = window.scrollY;
		const viewportBottom = viewportTop + window.innerHeight;

		return elementBottom > viewportTop && elementTop < viewportBottom;
	};
	const initialize = () => {
		const animateElements = document.querySelectorAll('[data-animate]');

		animate(animateElements);

		// TODO: this is firing every time a user scrolls. We might want to use debounce.
		// window.addEventListener('scroll', () => {
		// 	animate(animateElements);
		// });
	};

	initialize();
})(jQuery);
