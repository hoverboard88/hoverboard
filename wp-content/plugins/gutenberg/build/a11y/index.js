this.wp=this.wp||{},this.wp.a11y=function(e){var t={};function n(r){if(t[r])return t[r].exports;var i=t[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.r=function(e){Object.defineProperty(e,"__esModule",{value:!0})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=312)}({297:function(e,t){!function(){e.exports=this.wp.domReady}()},312:function(e,t,n){"use strict";n.r(t);var r=function(e){e=e||"polite";var t=document.createElement("div");return t.id="a11y-speak-"+e,t.className="a11y-speak-region",t.setAttribute("style","position: absolute;margin: -1px;padding: 0;height: 1px;width: 1px;overflow: hidden;clip: rect(1px, 1px, 1px, 1px);-webkit-clip-path: inset(50%);clip-path: inset(50%);border: 0;word-wrap: normal !important;"),t.setAttribute("aria-live",e),t.setAttribute("aria-relevant","additions text"),t.setAttribute("aria-atomic","true"),document.querySelector("body").appendChild(t),t},i=function(){for(var e=document.querySelectorAll(".a11y-speak-region"),t=0;t<e.length;t++)e[t].textContent=""},o=n(297),a=n.n(o),u="",p=function(e){return e=e.replace(/<[^<>]+>/g," "),u===e&&(e+=" "),u=e,e};n.d(t,"setup",function(){return s}),n.d(t,"speak",function(){return c});var s=function(){var e=document.getElementById("a11y-speak-polite"),t=document.getElementById("a11y-speak-assertive");null===e&&(e=r("polite")),null===t&&(t=r("assertive"))};a()(s);var c=function(e,t){i(),e=p(e);var n=document.getElementById("a11y-speak-polite"),r=document.getElementById("a11y-speak-assertive");r&&"assertive"===t?r.textContent=e:n&&(n.textContent=e)}}});