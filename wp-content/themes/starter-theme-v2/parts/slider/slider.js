(() => {
	const initialize = (slider) => {
		const element = slider.element;
		const options = JSON.parse(slider.options);

		return new Glide(element, {
			classes: {
				direction: {
					ltr: `${element.classList}--ltr`,
					rtl: `${element.classList}--rtl`,
				},
				slider: `${element.classList}--slider`,
				carousel: `${element.classList}--carousel`,
				swipeable: `${element.classList}--swipeable`,
				dragging: `${element.classList}--dragging`,
				cloneSlide: `${element.classList}__slide--clone`,
				activeNav: `${element.classList}__bullet--active`,
				activeSlide: `${element.classList}__slide--active`,
				disabledArrow: `${element.classList}__arrow--disabled`,
			},
		}).mount();
	};

	const slider = hb.setup('slider');

	slider.map(initialize);
})();
