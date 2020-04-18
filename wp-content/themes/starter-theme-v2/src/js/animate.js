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

	const debounce = function (func, wait, immediate) {
		let timeout;

		return () => {
			const context = this;
			const args = arguments;
			const later = () => {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};

			const callNow = immediate && !timeout;

			clearTimeout(timeout);

			timeout = setTimeout(later, wait);

			if (callNow) {
				func.apply(context, args);
			}
		};
	};

	const initialize = () => {
		const animateElements = document.querySelectorAll('[data-animate]');

		if (animateElements.length > 0) {
			animate(animateElements);

			window.addEventListener(
				'scroll',
				debounce(() => {
					animate(animateElements);
				}, 100)
			);
		}
	};

	initialize();
})(jQuery);
