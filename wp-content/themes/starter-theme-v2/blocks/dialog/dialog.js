(() => {
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
})();
