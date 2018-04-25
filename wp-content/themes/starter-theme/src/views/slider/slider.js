import Glide from '@glidejs/glide';
import {Controls, Breakpoints} from '@glidejs/glide/dist/glide.modular.esm';

const slider = new Glide('.slider', {
  type: 'carosel',
});

slider.mount({Controls, Breakpoints});
