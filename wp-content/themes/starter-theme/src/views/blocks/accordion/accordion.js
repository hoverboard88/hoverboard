class Accordion {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @memberof Accordion
   */
  constructor(element) {
    this.element = element;
  }
  get panelOption() {
    return this.element.dataset.option;
  }
  addAriaToPanels() {
    const panels = this.element.querySelectorAll('.accordion__panel');

    panels.forEach(panel => {
      panel.classList.remove('accordion__panel--no-js');
      this.ariaHidden(panel, 'true');
    });
  }
  addButtons() {
    const headings = this.element.querySelectorAll('.accordion__heading');

    headings.forEach((heading, index) => {
      const buttonText = heading.textContent;
      let newButton = document.createElement('button');

      index += 1;
      heading.classList.remove('accordion__heading--no-js');
      heading.innerHTML = '';
      newButton.setAttribute('type', 'button');
      newButton.setAttribute('id', `accordion-trigger-${index}`);
      newButton.classList.add('accordion__trigger');
      heading.appendChild(newButton);
      newButton.appendChild(document.createTextNode(buttonText));

      this.ariaExpanded(newButton, 'false');
    });
  }
  ariaExpanded(element, state) {
    element.setAttribute('aria-expanded', state);
  }
  ariaHidden(element, state) {
    element.setAttribute('aria-hidden', state);
  }
  click(event) {
    event.preventDefault();

    const option = this.panelOption;
    const panel = event.target.parentElement.nextSibling;
    const trigger = event.target.closest('.accordion__trigger');

    return option === 'single'
      ? this.openSinglePanel(trigger, panel)
      : this.openMultiplePanels(trigger, panel);
  }
  openSinglePanel(originalTrigger, siblingPanel) {
    const panels = this.element.querySelectorAll('.accordion__panel');
    const triggers = this.element.querySelectorAll('.accordion__trigger');

    panels.forEach(panel => {
      this.ariaHidden(panel, 'true');
    });

    triggers.forEach(trigger => {
      this.ariaExpanded(trigger, 'false');
    });

    this.ariaExpanded(originalTrigger, 'true');
    this.ariaHidden(siblingPanel, 'false');
  }
  openMultiplePanels(trigger, panel) {
    if (trigger.getAttribute('aria-expanded') === 'true') {
      this.ariaExpanded(trigger, 'false');
      this.ariaHidden(panel, 'true');
    } else {
      this.ariaExpanded(trigger, 'true');
      this.ariaHidden(panel, 'false');
    }
  }
  togglePanel() {
    const buttons = this.element.querySelectorAll('.accordion__trigger');

    buttons.forEach(button => {
      return button.addEventListener('click', this.click.bind(this));
    });
  }
  init() {
    const option = this.panelOption;

    this.addButtons();
    this.addAriaToPanels();
    this.togglePanel();

    if (option === 'single') {
      const firstPanel = this.element.querySelectorAll('.accordion__panel');
      const firstTrigger = this.element.querySelectorAll('.accordion__trigger');
      this.ariaExpanded(firstTrigger[0], 'true');
      this.ariaHidden(firstPanel[0], 'false');
    }
  }
}

export default Accordion;
