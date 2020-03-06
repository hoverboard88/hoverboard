const $ = jQuery;

export class MenuMobile {
	constructor(element, options = '{}') {
		this.element = element;
		this.options = JSON.parse(options);
	}
	addButtons() {
		const listItems = this.element.querySelectorAll('.menu-mobile__list > li > a');

		const addButton = listItem => {
			const hasSubMenu = $(listItem).siblings('.sub-menu').length;

			if (hasSubMenu) {
				const $button = $('<button>+</button>').attr('aria-expanded', 'false').attr('aria-label', 'Toggle Menu').addClass('sub-menu-toggle');
				$(listItem).before($button);
				$button.on('click', this.toggle);
			}

		}

		Array.from(listItems).map(addButton);
	}
	modal() {
		const menuClose = document.querySelector('.modal__close');
		const menuOpen = document.querySelector('.menu-toggle');

		const handler = (event) => {
			$('body').toggleClass('stop-scrolling');

			// prevent scrolling on iOS
			if ($('body').hasClass('stop-scrolling')) {
				document.ontouchmove = (e) => e.preventDefault();
			} else {
				document.ontouchmove = (e) => true;
			}

			$('.modal-overlay, .modal').attr('aria-hidden', (i, attr) => attr === 'true' ? 'false' : 'true')
		};

		$([menuClose, menuOpen]).on('click', handler);
	}
	toggle(event) {
		$(event.target).html((i, html) => html === '+' ? '–' : '+' );
		$(event.target).attr('aria-expanded', (i, attr) => attr === 'false' ? 'true' : 'false');
		$(event.target).siblings('.sub-menu').attr('aria-hidden', (i, attr) => attr === 'true' ? 'false' : 'true');
	}
	init() {
		const subMenus = this.element.querySelectorAll('.menu-mobile__list > li > .sub-menu');

		$(subMenus).attr('aria-hidden', 'true');

		this.addButtons();
		this.modal();
	}
};
