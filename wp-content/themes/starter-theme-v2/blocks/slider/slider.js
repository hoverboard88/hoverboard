(() => {
	const sliders = document.querySelectorAll('[data-module="slider"]');

	for (const slider of sliders) {
		const options = JSON.parse(slider.dataset.options);

		const s = new Glide(slider, {
			classes: {
				direction: {
					ltr: `${slider.classList}--ltr`,
					rtl: `${slider.classList}--rtl`,
				},
				slider: `${slider.classList}--slider`,
				carousel: `${slider.classList}--carousel`,
				swipeable: `${slider.classList}--swipeable`,
				dragging: `${slider.classList}--dragging`,
				cloneSlide: `${slider.classList}__slide--clone`,
				activeNav: `${slider.classList}__bullet--active`,
				activeSlide: `${slider.classList}__slide--active`,
				disabledArrow: `${slider.classList}__arrow--disabled`,
			},
		}).mount();
	}
})();
