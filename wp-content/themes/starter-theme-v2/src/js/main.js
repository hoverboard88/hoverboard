import { Accordion } from '../../modules/accordion/accordion.js';
import { Header } from '../../modules/header/header.js';
import { NavToggle } from '../../modules/nav-toggle/nav-toggle.js';
import { SearchToggle } from '../../modules/search-toggle/search-toggle.js';
import { Slider } from '../../modules/slider/slider.js';

const hb = {
	Accordion,
	Header,
	NavToggle,
	SearchToggle,
	Slider,
	getModules() { return Array.from(document.querySelectorAll('[data-init-js]')) },
	loadModules(element) {
		const className = element.dataset.initJs;
		const options = element.dataset.optionsJs;

		return new this[className](element, options).init();
	},
	init() {
		this.getModules().map(this.loadModules);
	}
};

hb.init();
