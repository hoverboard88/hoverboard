/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "http://hb-starter.lndo.site:8000/wp-content/themes/starter-theme/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(1);

__webpack_require__(6);

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(2);
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__(4)(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../node_modules/css-loader/index.js??ref--0-1!../../node_modules/postcss-loader/lib/index.js!./main.css", function() {
			var newContent = require("!!../../node_modules/css-loader/index.js??ref--0-1!../../node_modules/postcss-loader/lib/index.js!./main.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(3)(inline);
// imports


// module
exports.push([module.i, "/* Base */\n/* TODO: Variables not polyfilling for IE11 */\n/* Mixins go here */.visuallyhidden{font-size:0}\n/*! normalize.css v7.0.0 | MIT License | github.com/necolas/normalize.css */\n/* Document\n   ========================================================================== */\n/**\n * 1. Correct the line height in all browsers.\n * 2. Prevent adjustments of font size after orientation changes in\n *    IE on Windows Phone and in iOS.\n */html{line-height:1.15; /* 1 */-ms-text-size-adjust:100%; /* 2 */-webkit-text-size-adjust:100% /* 2 */}\n/* Sections\n   ========================================================================== */\n/**\n * Remove the margin in all browsers (opinionated).\n */body{margin:0}\n/**\n * Add the correct display in IE 9-.\n */article,aside,footer,header,nav,section{display:block}\n/**\n * Correct the font size and margin on `h1` elements within `section` and\n * `article` contexts in Chrome, Firefox, and Safari.\n */h1{font-size:2em;margin:0.67em 0}\n/* Grouping content\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n * 1. Add the correct display in IE.\n */figcaption,figure,main{ /* 1 */display:block}\n/**\n * Add the correct margin in IE 8.\n */figure{margin:1em 40px}\n/**\n * 1. Add the correct box sizing in Firefox.\n * 2. Show the overflow in Edge and IE.\n */hr{-webkit-box-sizing:content-box;box-sizing:content-box; /* 1 */height:0; /* 1 */overflow:visible /* 2 */}\n/**\n * 1. Correct the inheritance and scaling of font size in all browsers.\n * 2. Correct the odd `em` font sizing in all browsers.\n */pre{font-family:monospace,monospace; /* 1 */font-size:1em /* 2 */}\n/* Text-level semantics\n   ========================================================================== */\n/**\n * 1. Remove the gray background on active links in IE 10.\n * 2. Remove gaps in links underline in iOS 8+ and Safari 8+.\n */a{background-color:transparent; /* 1 */-webkit-text-decoration-skip:objects /* 2 */}\n/**\n * 1. Remove the bottom border in Chrome 57- and Firefox 39-.\n * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.\n */abbr[title]{border-bottom:none; /* 1 */text-decoration:underline; /* 2 */-webkit-text-decoration:underline dotted;text-decoration:underline dotted /* 2 */}\n/**\n * Prevent the duplicate application of `bolder` by the next rule in Safari 6.\n */b,strong{font-weight:inherit;font-weight:bolder}\n/**\n * Add the correct font weight in Chrome, Edge, and Safari.\n */\n/**\n * 1. Correct the inheritance and scaling of font size in all browsers.\n * 2. Correct the odd `em` font sizing in all browsers.\n */code,kbd,samp{font-family:monospace,monospace; /* 1 */font-size:1em /* 2 */}\n/**\n * Add the correct font style in Android 4.3-.\n */dfn{font-style:italic}\n/**\n * Add the correct background and color in IE 9-.\n */mark{background-color:#ff0;color:#000}\n/**\n * Add the correct font size in all browsers.\n */small{font-size:80%}\n/**\n * Prevent `sub` and `sup` elements from affecting the line height in\n * all browsers.\n */sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-0.25em}sup{top:-0.5em}\n/* Embedded content\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n */audio,video{display:inline-block}\n/**\n * Add the correct display in iOS 4-7.\n */audio:not([controls]){display:none;height:0}\n/**\n * Remove the border on images inside links in IE 10-.\n */img{border-style:none}\n/**\n * Hide the overflow in IE.\n */svg:not(:root){overflow:hidden}\n/* Forms\n   ========================================================================== */\n/**\n * 1. Change the font styles in all browsers (opinionated).\n * 2. Remove the margin in Firefox and Safari.\n */button,input,optgroup,select,textarea{font-family:sans-serif; /* 1 */font-size:100%; /* 1 */line-height:1.15; /* 1 */margin:0 /* 2 */}\n/**\n * Show the overflow in IE.\n * 1. Show the overflow in Edge.\n */button,input{ /* 1 */overflow:visible}\n/**\n * Remove the inheritance of text transform in Edge, Firefox, and IE.\n * 1. Remove the inheritance of text transform in Firefox.\n */button,select{ /* 1 */text-transform:none}\n/**\n * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`\n *    controls in Android 4.\n * 2. Correct the inability to style clickable types in iOS and Safari.\n */[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button /* 2 */}\n/**\n * Remove the inner border and padding in Firefox.\n */[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}\n/**\n * Restore the focus styles unset by the previous rule.\n */[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}\n/**\n * Correct the padding in Firefox.\n */fieldset{padding:0.35em 0.75em 0.625em}\n/**\n * 1. Correct the text wrapping in Edge and IE.\n * 2. Correct the color inheritance from `fieldset` elements in IE.\n * 3. Remove the padding so developers are not caught out when they zero out\n *    `fieldset` elements in all browsers.\n */legend{-webkit-box-sizing:border-box;box-sizing:border-box; /* 1 */color:inherit; /* 2 */display:table; /* 1 */max-width:100%; /* 1 */padding:0; /* 3 */white-space:normal /* 1 */}\n/**\n * 1. Add the correct display in IE 9-.\n * 2. Add the correct vertical alignment in Chrome, Firefox, and Opera.\n */progress{display:inline-block; /* 1 */vertical-align:baseline /* 2 */}\n/**\n * Remove the default vertical scrollbar in IE.\n */textarea{overflow:auto}\n/**\n * 1. Add the correct box sizing in IE 10-.\n * 2. Remove the padding in IE 10-.\n */[type=checkbox],[type=radio]{-webkit-box-sizing:border-box;box-sizing:border-box; /* 1 */padding:0 /* 2 */}\n/**\n * Correct the cursor style of increment and decrement buttons in Chrome.\n */[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}\n/**\n * 1. Correct the odd appearance in Chrome and Safari.\n * 2. Correct the outline style in Safari.\n */[type=search]{-webkit-appearance:textfield; /* 1 */outline-offset:-2px /* 2 */}\n/**\n * Remove the inner padding and cancel buttons in Chrome and Safari on macOS.\n */[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}\n/**\n * 1. Correct the inability to style clickable types in iOS and Safari.\n * 2. Change font properties to `inherit` in Safari.\n */::-webkit-file-upload-button{-webkit-appearance:button; /* 1 */font:inherit /* 2 */}\n/* Interactive\n   ========================================================================== */\n/*\n * Add the correct display in IE 9-.\n * 1. Add the correct display in Edge, IE, and Firefox.\n */details,menu{display:block}\n/*\n * Add the correct display in all browsers.\n */summary{display:list-item}\n/* Scripting\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n */canvas{display:inline-block}\n/**\n * Add the correct display in IE.\n */\n/* Hidden\n   ========================================================================== */\n/**\n * Add the correct display in IE 10-.\n */[hidden],template{display:none}\n/*\n * typography.css: Add global styles that refer to type\n */body{\n  /* Base body styles */}.container{max-width:1200px;margin:0 auto}\n/*\n * forms.css: Add global styles that refer to forms\n */form{\n  /* Base body styles */}\n/* Modules */.hero{display:-webkit-box;display:-ms-flexbox;display:flex}.hero .hero__title{background:#000;color:#fff}", "", {"version":3,"sources":["/Users/ryantvenge/Sites/lando/starter-template/wp-content/themes/starter-theme/src/css/main.css"],"names":[],"mappings":"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","file":"main.css","sourcesContent":["/* Base */\n/* TODO: Variables not polyfilling for IE11 */\n/* Mixins go here */.visuallyhidden{font-size:0}\n/*! normalize.css v7.0.0 | MIT License | github.com/necolas/normalize.css */\n/* Document\n   ========================================================================== */\n/**\n * 1. Correct the line height in all browsers.\n * 2. Prevent adjustments of font size after orientation changes in\n *    IE on Windows Phone and in iOS.\n */html{line-height:1.15; /* 1 */-ms-text-size-adjust:100%; /* 2 */-webkit-text-size-adjust:100% /* 2 */}\n/* Sections\n   ========================================================================== */\n/**\n * Remove the margin in all browsers (opinionated).\n */body{margin:0}\n/**\n * Add the correct display in IE 9-.\n */article,aside,footer,header,nav,section{display:block}\n/**\n * Correct the font size and margin on `h1` elements within `section` and\n * `article` contexts in Chrome, Firefox, and Safari.\n */h1{font-size:2em;margin:0.67em 0}\n/* Grouping content\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n * 1. Add the correct display in IE.\n */figcaption,figure,main{ /* 1 */display:block}\n/**\n * Add the correct margin in IE 8.\n */figure{margin:1em 40px}\n/**\n * 1. Add the correct box sizing in Firefox.\n * 2. Show the overflow in Edge and IE.\n */hr{-webkit-box-sizing:content-box;box-sizing:content-box; /* 1 */height:0; /* 1 */overflow:visible /* 2 */}\n/**\n * 1. Correct the inheritance and scaling of font size in all browsers.\n * 2. Correct the odd `em` font sizing in all browsers.\n */pre{font-family:monospace,monospace; /* 1 */font-size:1em /* 2 */}\n/* Text-level semantics\n   ========================================================================== */\n/**\n * 1. Remove the gray background on active links in IE 10.\n * 2. Remove gaps in links underline in iOS 8+ and Safari 8+.\n */a{background-color:transparent; /* 1 */-webkit-text-decoration-skip:objects /* 2 */}\n/**\n * 1. Remove the bottom border in Chrome 57- and Firefox 39-.\n * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.\n */abbr[title]{border-bottom:none; /* 1 */text-decoration:underline; /* 2 */-webkit-text-decoration:underline dotted;text-decoration:underline dotted /* 2 */}\n/**\n * Prevent the duplicate application of `bolder` by the next rule in Safari 6.\n */b,strong{font-weight:inherit;font-weight:bolder}\n/**\n * Add the correct font weight in Chrome, Edge, and Safari.\n */\n/**\n * 1. Correct the inheritance and scaling of font size in all browsers.\n * 2. Correct the odd `em` font sizing in all browsers.\n */code,kbd,samp{font-family:monospace,monospace; /* 1 */font-size:1em /* 2 */}\n/**\n * Add the correct font style in Android 4.3-.\n */dfn{font-style:italic}\n/**\n * Add the correct background and color in IE 9-.\n */mark{background-color:#ff0;color:#000}\n/**\n * Add the correct font size in all browsers.\n */small{font-size:80%}\n/**\n * Prevent `sub` and `sup` elements from affecting the line height in\n * all browsers.\n */sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-0.25em}sup{top:-0.5em}\n/* Embedded content\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n */audio,video{display:inline-block}\n/**\n * Add the correct display in iOS 4-7.\n */audio:not([controls]){display:none;height:0}\n/**\n * Remove the border on images inside links in IE 10-.\n */img{border-style:none}\n/**\n * Hide the overflow in IE.\n */svg:not(:root){overflow:hidden}\n/* Forms\n   ========================================================================== */\n/**\n * 1. Change the font styles in all browsers (opinionated).\n * 2. Remove the margin in Firefox and Safari.\n */button,input,optgroup,select,textarea{font-family:sans-serif; /* 1 */font-size:100%; /* 1 */line-height:1.15; /* 1 */margin:0 /* 2 */}\n/**\n * Show the overflow in IE.\n * 1. Show the overflow in Edge.\n */button,input{ /* 1 */overflow:visible}\n/**\n * Remove the inheritance of text transform in Edge, Firefox, and IE.\n * 1. Remove the inheritance of text transform in Firefox.\n */button,select{ /* 1 */text-transform:none}\n/**\n * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`\n *    controls in Android 4.\n * 2. Correct the inability to style clickable types in iOS and Safari.\n */[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button /* 2 */}\n/**\n * Remove the inner border and padding in Firefox.\n */[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}\n/**\n * Restore the focus styles unset by the previous rule.\n */[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}\n/**\n * Correct the padding in Firefox.\n */fieldset{padding:0.35em 0.75em 0.625em}\n/**\n * 1. Correct the text wrapping in Edge and IE.\n * 2. Correct the color inheritance from `fieldset` elements in IE.\n * 3. Remove the padding so developers are not caught out when they zero out\n *    `fieldset` elements in all browsers.\n */legend{-webkit-box-sizing:border-box;box-sizing:border-box; /* 1 */color:inherit; /* 2 */display:table; /* 1 */max-width:100%; /* 1 */padding:0; /* 3 */white-space:normal /* 1 */}\n/**\n * 1. Add the correct display in IE 9-.\n * 2. Add the correct vertical alignment in Chrome, Firefox, and Opera.\n */progress{display:inline-block; /* 1 */vertical-align:baseline /* 2 */}\n/**\n * Remove the default vertical scrollbar in IE.\n */textarea{overflow:auto}\n/**\n * 1. Add the correct box sizing in IE 10-.\n * 2. Remove the padding in IE 10-.\n */[type=checkbox],[type=radio]{-webkit-box-sizing:border-box;box-sizing:border-box; /* 1 */padding:0 /* 2 */}\n/**\n * Correct the cursor style of increment and decrement buttons in Chrome.\n */[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}\n/**\n * 1. Correct the odd appearance in Chrome and Safari.\n * 2. Correct the outline style in Safari.\n */[type=search]{-webkit-appearance:textfield; /* 1 */outline-offset:-2px /* 2 */}\n/**\n * Remove the inner padding and cancel buttons in Chrome and Safari on macOS.\n */[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}\n/**\n * 1. Correct the inability to style clickable types in iOS and Safari.\n * 2. Change font properties to `inherit` in Safari.\n */::-webkit-file-upload-button{-webkit-appearance:button; /* 1 */font:inherit /* 2 */}\n/* Interactive\n   ========================================================================== */\n/*\n * Add the correct display in IE 9-.\n * 1. Add the correct display in Edge, IE, and Firefox.\n */details,menu{display:block}\n/*\n * Add the correct display in all browsers.\n */summary{display:list-item}\n/* Scripting\n   ========================================================================== */\n/**\n * Add the correct display in IE 9-.\n */canvas{display:inline-block}\n/**\n * Add the correct display in IE.\n */\n/* Hidden\n   ========================================================================== */\n/**\n * Add the correct display in IE 10-.\n */[hidden],template{display:none}\n/*\n * typography.css: Add global styles that refer to type\n */body{\n  /* Base body styles */}.container{max-width:1200px;margin:0 auto}\n/*\n * forms.css: Add global styles that refer to forms\n */form{\n  /* Base body styles */}\n/* Modules */.hero{display:-webkit-box;display:-ms-flexbox;display:flex}.hero .hero__title{background:#000;color:#fff}"],"sourceRoot":""}]);

// exports


/***/ }),
/* 3 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getElement = (function (fn) {
	var memo = {};

	return function(selector) {
		if (typeof memo[selector] === "undefined") {
			memo[selector] = fn.call(this, selector);
		}

		return memo[selector]
	};
})(function (target) {
	return document.querySelector(target)
});

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(5);

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton) options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
	if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else {
		throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	options.attrs.type = "text/css";

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	options.attrs.type = "text/css";
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = options.transform(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),
/* 5 */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ }),
/* 6 */
/***/ (function(module, exports) {

// TODO: This isn't loading...
console.log('Hero js loaded');

/***/ })
/******/ ]);