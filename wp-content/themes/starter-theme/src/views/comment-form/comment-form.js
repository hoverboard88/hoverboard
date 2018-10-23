/**
 * Simple Comment Toggle
 * @class CommentToggle
 */
class CommentToggle {
  /**
   * Creates an instance of CommentToggle.
   * @param {any} element HTML element of the CommentToggle
   * @param {string} [options='{}'] Options provided by data-options-js data attribute
   * @memberof CommentToggle
   */
  constructor(element, options = '{}') {
    this.element = element;
    this.options = JSON.parse(options);
    this.forms = element.querySelectorAll('.js-comment-form__form');
    this.first = this.forms[0];
    this.itemClass = this.first.classList[0];
    this.hideClass = `${this.itemClass}--hide`;
  }

  /**
   * OnClick will toggle the active classes.
   * @param {*} event Click event
   */
  click(event) {
    event.target.classList.toggle('comment-form__toggle--expanded');
    const item = this.element.querySelector('.js-comment-form__form');
    event.preventDefault();
    item.classList.toggle(this.hideClass);
  }

  /**
   * Adds the click event listener to all buttons of the CommentToggle.
   * @memberof CommentToggle
   */
  toggle() {
    const buttons = this.element.querySelectorAll('.js-comment-form__toggle');

    Array.from(buttons).map(button => {
      return button.addEventListener('click', this.click.bind(this));
    });
  }

  /**
   * Initialize.
   */
  init() {
    this.toggle();

    Array.from(this.forms).forEach(form => {
      form.classList.add(this.hideClass);
    });
  }
}

export default CommentToggle;
