(() => {
	const sliders = document.querySelectorAll('[data-block="slider"]');

	for (const slider of sliders) {
		new Glide(slider, {
			classes: {
				direction: {
					ltr: 'slider--ltr',
					rtl: 'slider--rtl',
				},
				slider: 'slider--slider',
				carousel: 'slider--carousel',
				swipeable: 'slider--swipeable',
				dragging: 'slider--dragging',
				cloneSlide: 'slider__slide--clone',
				activeNav: 'slider__bullet--active',
				activeSlide: 'slider__slide--active',
				disabledArrow: 'slider__arrow--disabled',
			},
		}).mount();
	}
})();
