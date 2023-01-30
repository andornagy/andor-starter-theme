import $ from 'jquery';
import Splide from '@splidejs/splide';

class SplideSlider {
    constructor() {
        this.events();
    }

    events() {
        const sliders = document.querySelectorAll('.splide');
        if (!sliders.length) return;
        const splide = new Splide('.splide', {
            type: 'loop',
            gap: '1rem',
            arrows: true,
            pagination: true,
            autoplay: false,
            autoHeight: true,
        }).mount();

        splide.on('move', function (newIndex, oldIndex, destIndex) {
            newIndex += 1;
            var _height = $(
                '#splide01-slide0' + newIndex + ' > div'
            ).outerHeight();

            const list = document.querySelector('.splide__list');
            if (!list) return;

            // list.style.transition = 'transform .4s, height .4s';
            list.style.height = _height + 'px';
            // $('.splide__list').height(_height);
        });

        $(document).ready(() => {
            jQuery('.splide__list').height(
                jQuery('#splide01-slide01 > div').outerHeight()
            );
            jQuery('.splide__list').addClass('transition');
        });
    }
}

export default SplideSlider;
