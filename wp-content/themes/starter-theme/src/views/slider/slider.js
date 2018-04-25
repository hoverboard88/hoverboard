import Glide from '@glidejs/glide';
import {Controls, Breakpoints} from '@glidejs/glide/dist/glide.modular.esm';

new Glide('.slider', {
  type: 'carousel',
}).mount({Controls, Breakpoints});
