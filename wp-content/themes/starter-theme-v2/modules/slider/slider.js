import Glide, { Controls, Breakpoints } from '@glidejs/glide/dist/glide.modular.esm';

export class Slider {
	constructor(element, options = '{}') {
		this.element = element;
		this.options = JSON.parse(options);
	}
	init() {
		return new Glide(this.element).mount({ Controls, Breakpoints });
	}
}
