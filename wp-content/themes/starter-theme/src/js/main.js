import '../css/main.css'; // …so webpack can bundle css

// Initialize Modules
const modules = document.querySelectorAll('[data-init-js]');
const blocks = document.querySelectorAll('[data-block-init-js]');

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

Array.from(blocks).map(block => {
  const blockName = block.dataset.blockInitJs;
  const blockOptions = block.dataset.optionsJs;
  const blockLoad = require('../views/blocks/' +
    blockName +
    '/' +
    blockName +
    '.js');

  return new blockLoad.default(block, blockOptions).init();
});
