// TODO: Make so multiple lightboxes can be on one page

const button = document.querySelector('.lightbox__button');
const close = document.querySelector('.lightbox__close');
const overlay = document.querySelector('.lightbox__overlay');
const popup = document.querySelector('.lightbox__popup');

// Open when lightbox button is clicked
button.addEventListener('click', event => {
  event.preventDefault();

  document.querySelector('body').classList.add('lightbox-active');
});

// Close when close button is clicked
close.addEventListener('click', event => {
  event.preventDefault();

  document.querySelector('body').classList.remove('lightbox-active');
});

// Close when overlay is clicked
overlay.addEventListener('click', event => {
  event.preventDefault();

  document.querySelector('body').classList.remove('lightbox-active');
});

// Don't bubble click event from overlay element
popup.addEventListener('click', event => {
  event.stopPropagation();
});
