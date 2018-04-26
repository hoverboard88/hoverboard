class MobileMenu {
  constructor() {}
  click(event) {
    event.preventDefault();
    document.querySelector('body').classList.toggle('js-mobile-menu-active');
  }
  toggle() {
    document
      .querySelector('.mobile-toggle')
      .addEventListener('click', this.click);

    document
      .querySelector('.mobile-menu__toggle')
      .addEventListener('click', this.click);

    document
      .querySelector('.mobile-menu__overlay')
      .addEventListener('click', this.click);
  }
  init(options) {
    this.toggle();
  }
}

export default MobileMenu;
