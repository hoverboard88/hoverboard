class Accordion {
  constructor(open = true) {
    this.open = open;
  }
  get firstItem() {
    const accordions = document.querySelectorAll('.accordion');

    Array.from(accordions).map(accordion => {
      const first = accordion.getElementsByClassName('accordion__item')[0];
      first.classList.add('accordion__item--active');
    });
  }
  click(event) {
    const accordion = this.parentNode.parentNode;
    const item = this.parentNode;

    event.preventDefault();

    Array.from(accordion.children).map(items => {
      items.classList.remove('accordion__item--active');
    });

    item.classList.toggle('accordion__item--active');
  }
  toggle() {
    const buttons = document.querySelectorAll('.accordion__button');

    Array.from(buttons).map(button => {
      button.addEventListener('click', this.click);
    });
  }

  init(options) {
    if (options) {
      this.open = options.open;
    }

    if (this.open) {
      this.firstItem;
    }

    this.toggle();
  }
}

export default Accordion;
