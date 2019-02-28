// import '@fancyapps/fancybox';

import 'magnific-popup';
import '../../node_modules/magnific-popup/dist/magnific-popup.css';

/**
 * Lightbox
 * @class Lightbox
 */

class Lightbox {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @memberof Lightbox
   */
  constructor() {
    // Any img with the wp-image-* class that also has a parent that links to a jpg
    this.selector = 'a[href*=".jpg"]:has(img[class*="wp-image-"])';
  }

  lightbox() {
    $('#content').magnificPopup({
      delegate: this.selector,
      type: 'image',
      gallery: {
        enabled: true,
      },
    });
  }

  /**
   * Initialize.
   */
  init() {
    console.log($);

    this.lightbox();
  }
}

export default Lightbox;
