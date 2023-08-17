(() => {
	const checkMenu = (menu) => {
		const menuItems = menu.querySelectorAll('.menu-item');
		const menuItemsArray = Array.from(menuItems);
		const menuItemsRight = menuItemsArray.filter(
			(item) => item.getBoundingClientRect().right > window.innerWidth / 2
		);

		menuItemsArray.forEach((item) =>
			item.classList.remove('js-menu-item-right')
		);

		Array.from(menuItemsRight).forEach((item) =>
			item.classList.add('js-menu-item-right')
		);
	};

	const menuHeader = document.querySelector('.menu-header');

	checkMenu(menuHeader);

	const resize = () => {
		requestAnimationFrame(() => {
			checkMenu(menuHeader);
		});
	};

	window.addEventListener('resize', () => resize());
})();
