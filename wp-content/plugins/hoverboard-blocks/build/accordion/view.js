/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./src/accordion/view.js ***!
  \*******************************/
const accordions = document.querySelectorAll(".accordion");
const accordionContent = Array.from(accordions).map(accordion => accordion.querySelectorAll(".accordion__content"));
accordions.forEach(accordion => addButtonsToHeadings(accordion));
accordionContent.forEach(elements => initializeAccordionContent(elements));

function initializeAccordionContent(elements, index) {
  return elements.forEach((element, index) => toggleFirstAccordionContent(element, index));
}

function toggleFirstAccordionContent(element, index) {
  const toggle = element.parentElement.parentElement.dataset.hbAccordionOpen;
  return toggle === "open" && index === 0 ? toggleAriaAttribute(element, "aria-hidden", "false") : toggleAriaAttribute(element, "aria-hidden", "true");
}

function addButtonsToHeadings(element) {
  const headings = element.querySelectorAll(".accordion__heading");
  return Array.from(headings).map(addButtonToHeading);
}

function addButtonToHeading(heading, index) {
  const buttonText = heading.textContent;
  let newButton = document.createElement("button");
  index += 1;
  heading.innerHTML = "";
  newButton.setAttribute("type", "button");
  newButton.classList.add("accordion__trigger");
  newButton.addEventListener("click", accordionEventHandler, false);
  heading.appendChild(newButton);
  newButton.appendChild(document.createTextNode(buttonText));
  toggleAriaAttribute(newButton, "aria-expanded", "false");
  return heading;
}

function accordionEventHandler(event) {
  event.preventDefault();
  const accordion = event.target.parentElement.parentElement.parentElement;
  const allAccordionContent = accordion.querySelectorAll(".accordion__content");
  const parentAccordionContent = event.target.parentElement.nextElementSibling;
  const type = accordion.dataset.hbAccordion;
  return type === "default" ? toggleAccordionContent(parentAccordionContent) : toggleFlushAccordionContent(parentAccordionContent, allAccordionContent);
}

function toggleAriaAttribute(element, attribute, state) {
  return element.setAttribute(attribute, state);
}

function toggleAccordionContent(element) {
  const state = element.getAttribute("aria-hidden");
  return state === "false" ? toggleAriaAttribute(element, "aria-hidden", "true") : toggleAriaAttribute(element, "aria-hidden", "false");
}

function toggleFlushAccordionContent(parent, elements) {
  const state = parent.getAttribute("aria-hidden");

  if (state === "false") {
    elements.forEach(element => toggleAriaAttribute(element, "aria-hidden", "true"));
  } else {
    elements.forEach(element => toggleAriaAttribute(element, "aria-hidden", "true"));
    toggleAriaAttribute(parent, "aria-hidden", "false");
  }
}
/******/ })()
;
//# sourceMappingURL=view.js.map