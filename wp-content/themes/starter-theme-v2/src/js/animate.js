(() => {
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

	const debounce = (callback, wait) => {
		let timeout;
		return (...args) => {
			const context = this;
			clearTimeout(timeout);
			timeout = setTimeout(() => callback.apply(context, args), wait);
		};
	};

	const animateClasses = () => {
		const elements = document.querySelectorAll('[class*="js-animate-"]');

		elements.forEach((element) => {
			const animation = element
				.getAttribute('class')
				.match(/js-animate-([^\ ]*)/i)[1];

			element.setAttribute('data-animate', animation);
		});
	};

	const initialize = () => {
		animateClasses();

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
})();
