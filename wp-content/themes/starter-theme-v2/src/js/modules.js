const modules = document.querySelectorAll('[data-init-js]');

import {Slider} from '../../assets/js/_rollup:plugin-multi-entry:entry-point.js';
console.log(Slider);

const importModules = module => {
	const name = module.dataset.initJs;
	const options = module.dataset.optionsJs;
	console.log(name);

	// TODO: https://2ality.com/2017/01/import-operator.html
	// Promise.all() ??
	import(`../../modules/${name}/${name}.js`)
		.then(moduleObj => initializeModule(moduleObj, module, options))
		.catch(error => console.error(error));
};

const initializeModule = (moduleObj, element, options) => {
	console.log(moduleObj);
	console.log(element);
	console.log(options);

	const moduleClass = Object.values(moduleObj)[0];

	return new moduleClass(element, options).init();
};

Array.from(modules).map(importModules);
