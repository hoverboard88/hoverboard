const path = require('path');
const fs = require('fs');
const postcss = require('postcss');
const postcssImport = require('postcss-import');
const globby = require('globby');

const getAllModules = () => {
  const modules = [
    process.cwd() + '/src/views/!(_deactivated)/**/!(*.editor.css)*.css',
  ];

  return globby(modules).then(files => {
    console.log(files);

    const res = files.map(f => path.normalize(f));
    return res;
  });
};

const getAllEditorModules = () => {
  const modules = process.cwd() + '/src/views/blocks/**/*.editor.css';

  return globby(modules).then(files => {
    const res = files.map(f => path.normalize(f));
    return res;
  });
};

const findFile = (id, base) => {
  const parsed = path.parse(id);
  const formats = [
    '%', // full file path
    '%.css', // CSS
    '%/main.css', // Folder containing CSS
  ];

  let out = [];
  let file = '';
  formats.forEach(format => {
    let unresolved = path.join(parsed.dir, format.replace('%', parsed.base));
    out.push(path.join(base, unresolved));
    file = out.reduce((a, b) => {
      if (fs.existsSync(a)) {
        return a;
      }
      return b;
    });
  });

  return Promise.resolve(file);
};

const resolve = (id, base, options) => {
  if (/<Modules>/.test(id)) {
    return getAllModules();
  } else if (/<EditorModules>/.test(id)) {
    return getAllEditorModules();
  } else {
    return findFile(id, base);
  }
};

const init = (opts = {}) => {
  opts.resolve = resolve;
  return postcss([postcssImport(opts)]);
};

module.exports = postcss.plugin('postcss-module-import', init);
