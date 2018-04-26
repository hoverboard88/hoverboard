import '../css/main.css'; // …so webpack can bundle css

// Initialize Modules
const modules = document.querySelectorAll('[data-init-js]');

Array.from(modules).map(module => {
  const moduleName = module.dataset.initJs;
  const moduleOptions = module.dataset.optionsJs;
  const moduleLoad = require('../views/' +
    moduleName +
    '/' +
    moduleName +
    '.js');

  return new moduleLoad.default(module, moduleOptions).init();
});
