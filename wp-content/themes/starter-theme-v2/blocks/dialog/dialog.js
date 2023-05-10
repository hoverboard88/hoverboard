(() => {
	console.log('dialog.js', window);
	const dialogs = document.querySelectorAll('[data-block="dialog"]');
	const showDialogButtons = document.querySelectorAll(
		'[data-block="dialog-btn"]'
	);

	for (const button of showDialogButtons) {
		button.addEventListener('click', showDialog);
	}

	function showDialog(event) {
		const dialog = event.target.previousElementSibling;
		dialog.showModal();
	}

	// const toggle = (popup, overlay, event) => {
	// 	const body = document.body;
	// 	event.preventDefault();
	// 	body.classList.toggle('no-scroll');
	// 	// prevent scrolling on iOS
	// 	if (body.classList.contains('no-scroll')) {
	// 		document.ontouchmove = (e) => e.preventDefault();
	// 	} else {
	// 		document.ontouchmove = (e) => true;
	// 	}
	// 	popup.classList.toggle('popup--active');
	// 	overlay.classList.toggle('popup-overlay--active');
	// };
	// const initialize = (popup) => {
	// 	const element = popup.element;
	// 	const options = JSON.parse(popup.options);
	// 	const closeButton = element.querySelector('.popup__close');
	// 	const openButton = element.nextElementSibling;
	// 	const overlay = element.previousElementSibling;
	// 	closeButton.addEventListener('click', toggle.bind(this, element, overlay));
	// 	openButton.addEventListener('click', toggle.bind(this, element, overlay));
	// };
	// const popup = hb.setup('popup');
	// popup.map(initialize);
})();
