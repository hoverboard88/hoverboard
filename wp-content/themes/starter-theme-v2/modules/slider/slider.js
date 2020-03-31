import Glide, {
	Controls,
	Breakpoints,
} from '@glidejs/glide/dist/glide.modular.esm';

export class Slider {
	constructor(element, options = '{}') {
		this.element = element;
		this.options = JSON.parse(options);
		this.cssClass = this.element.classList[0];
	}
	init() {
		return new Glide(this.element, {
			classes: {
				direction: {
					ltr: `${this.cssClass}--ltr`,
					rtl: `${this.cssClass}--rtl`,
				},
				slider: `${this.cssClass}--slider`,
				carousel: `${this.cssClass}--carousel`,
				swipeable: `${this.cssClass}--swipeable`,
				dragging: `${this.cssClass}--dragging`,
				cloneSlide: `${this.cssClass}__slide--clone`,
				activeNav: `${this.cssClass}__bullet--active`,
				activeSlide: `${this.cssClass}__slide--active`,
				disabledArrow: `${this.cssClass}__arrow--disabled`,
			},
		}).mount({ Controls, Breakpoints });
	}
}
