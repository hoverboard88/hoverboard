import '../css/main.css'; // …so webpack can bundle css

// Initialize Modules
const modules = document.querySelectorAll('[data-init-js]');

Array.from(modules).forEach(module => {
  const moduleName = module.dataset.initJs;
  const moduleOptions = module.dataset.optionsJs;
  const moduleLoad = require('../views/' +
    moduleName +
    '/' +
    moduleName +
    '.js');
  return moduleOptions
    ? new moduleLoad.default().init(JSON.parse(moduleOptions))
    : new moduleLoad.default().init();
});
