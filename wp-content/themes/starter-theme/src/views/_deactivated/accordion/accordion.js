// TODO: Doesn't work if more than one accordion is on the page.
const accordion = document.querySelector('.accordion');
const accordionItems = accordion.querySelectorAll('.accordion__item');
const accordionButtons = accordion.querySelectorAll('.accordion__button');

// If you want the first open by default
accordionItems[0].classList.add('accordion__item--active');

accordionButtons.forEach(button => {
  button.addEventListener('click', event => {
    event.preventDefault();

    accordionItems.forEach(item => {
      item.classList.remove('accordion__item--active');
    });

    // add active class to item
    button.parentNode.classList.add('accordion__item--active');
  });
});
