// import '../js/**/*.js';

const modules = document.querySelectorAll('[data-init-js]');

const importModules = module => {
	const name = module.dataset.initJs;
	const options = module.dataset.optionsJs;

	// TODO: https://2ality.com/2017/01/import-operator.html
	// Promise.all() ??
	import(`../../modules/${name}/${name}.js`)
		.then(moduleObj => initializeModule(moduleObj, module, options))
		.catch(error => console.error(error));
}

const initializeModule = (moduleObj, element, options) => {
	const moduleClass = Object.values(moduleObj)[0];
	return new moduleClass(element, options).init();
}

Array.from(modules).map(importModules);