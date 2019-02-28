import '@fancyapps/fancybox';

/**
 * Lightbox
 * @class Lightbox
 */

// import MagnificPopup from 'magnific-popup/dist/jquery.magnific-popup.min.js';

class Lightbox {
  /**
   * Creates an instance of Accordion.
   * @param {any} element HTML element of the accordion
   * @memberof Lightbox
   */
  constructor() {
    // Any img with the wp-image-* class that also has a parent
    this.contentImages = jQuery('img[class*="wp-image-"]').parent(
      'a[href*=".jpg"]'
    );
    this.anchorClass = jQuery('.lightbox');
  }

  lightbox(anchors) {
    anchors.fancybox();
  }

  /**
   * Initialize.
   */
  init() {
    this.lightbox(this.contentImages);
    this.lightbox(this.anchorClass);
  }
}

export default Lightbox;
