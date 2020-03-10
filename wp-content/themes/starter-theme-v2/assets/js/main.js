var modules = document.querySelectorAll('[data-init-js]');

var importModules = function importModules(module) {
  var name = module.dataset.initJs;
  var options = module.dataset.optionsJs; // TODO: https://2ality.com/2017/01/import-operator.html
  // Promise.all() ??

  import("../../modules/".concat(name, "/").concat(name, ".js")).then(function (moduleObj) {
    return initializeModule(moduleObj, module, options);
  })["catch"](function (error) {
    return console.error(error);
  });
};

var initializeModule = function initializeModule(moduleObj, element, options) {
  var moduleClass = Object.values(moduleObj)[0];
  return new moduleClass(element, options).init();
};

Array.from(modules).map(importModules);
