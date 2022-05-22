import $ from 'jquery';

class MegaMenu {
    constructor() {
        this.navItems = $(
            '.nav--desktop > .nav > .menu > .menu-item-has-children'
        );
        this.searchIcon = document.querySelector('.nav-search');
        this.search = $('#header-search');
        this.events();
        this.resizeTimer;
    }

    events() {
        for (const item of this.navItems) {
            $(item).hover(this.showSubnav.bind(this, item), () => {
                item.timer = setTimeout(this.closeSubnav.bind(item), 400);
            });
        }

        this.moveArrows();
        window.addEventListener('resize', () => {
            clearTimeout(this.resizeTimer);
            this.resizeTimer = setTimeout(this.moveArrows.bind(this), 100);
        });
    }

    // Methods

    showSubnav(target) {
        const subnav = $(target).find('.sub-menu').first();
        if (!subnav.hasClass('active')) {
            for (const item of this.navItems) {
                const subnav = $(item).find('.sub-menu').first();
                if ($(subnav).hasClass('active')) {
                    $(subnav).hide(0);
                }
            }
            // Hide search
            if (this.search.hasClass('active')) {
                this.search.fadeOut(0);
                this.search.removeClass('active');
            }

            subnav.addClass('active');
            subnav.fadeIn(400);
        } else {
            clearTimeout(target.timer);
        }

        return false;
    }

    closeSubnav() {
        const subnav = $(this).find('.sub-menu').first();
        if (subnav.hasClass('active')) {
            subnav.fadeOut(400, () => {
                subnav.removeClass('active');
            });
        }
    }

    moveArrows() {
        for (const item of this.navItems) {
            this.moveArrow(item);
        }
        this.moveArrow(this.searchIcon);
    }

    moveArrow(item) {
        if (!item) return;
        const arrow = $(item).find('.sub-menu__arrow').first();
        const position = item.getBoundingClientRect();
        console.log(
            position.left,
            $(item).width() / 2,
            Math.abs(arrow.width()) / 2
        );
        arrow.css(
            'left',
            position.left +
                $(item).width() / 2 -
                Math.abs(arrow.width()) / 2 +
                'px'
        );
    }
}

export default MegaMenu;
