const hb = (() => {
	const setup = (module) => getModules(module).map(moduleData);
	const getModules = (module) =>
		Array.from(document.querySelectorAll(`[data-module="${module}"]`));
	const moduleData = (element) => {
		let { module, options = '{}' } = element.dataset;
		return { element, module, options };
	};

	return { setup };
})();
