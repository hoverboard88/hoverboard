(function () {
  document.querySelector('.mobile-toggle').addEventListener('click', (e) => toggleBodyClass(e))
  document.querySelector('.mobile-menu__toggle').addEventListener('click', (e) => toggleBodyClass(e))
  document.querySelector('.mobile-menu__overlay').addEventListener('click', (e) => toggleBodyClass(e))

  function toggleBodyClass (event) {
    event.preventDefault()
    document.querySelector('body').classList.toggle('js-mobile-menu-active')
  }
}())
