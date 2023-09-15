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

	const menuListItems = document.querySelectorAll(
		'.menu-header__list > li.menu-item-has-children'
	);

	Array.from(menuListItems).map(addNavigationToggleBtn);

	// Expands the menu if the current page is the parent page or a child of it.
	Array.from(menuListItems)
		.filter((item) => item.classList.contains('current-menu-item'))
		.forEach((item) => {
			const dropDownMenu = item.querySelector('ul');
			item.querySelector('.menu-header__btn').textContent = 'Collapse';
			item
				.querySelector('.menu-header__btn')
				.classList.add('menu-header__btn--expanded');
			dropDownMenu.classList.add('sub-menu--active');
		});

	function addNavigationToggleBtn(item) {
		const btn = document.createElement('button');

		btn.addEventListener('click', (e) => navigationToggleClickHandler(e, item));
		btn.classList.add('menu-header__btn');
		btn.textContent = 'Expand';

		item.append(btn);
	}

	function navigationToggleClickHandler(e, item) {
		e.preventDefault();
		const dropDownMenu = item.querySelector('ul');
		const hasShowClass = dropDownMenu.classList.contains('sub-menu--active');

		if (hasShowClass) {
			e.target.classList.remove('menu-header__btn--expanded');
			e.target.textContent = 'Expand';
		} else {
			e.target.classList.add('menu-header__btn--expanded');
			e.target.textContent = 'Collapse';
		}

		dropDownMenu.classList.toggle('sub-menu--active');
	}
})();
