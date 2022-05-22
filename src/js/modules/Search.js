import $ from 'jquery';

class Search {
    constructor() {
        this.searchIcon = $('.nav-search__icon');
        this.search = $('#header-search');
        this.subnavs = $(
            '.nav--desktop > .nav > .menu > .menu-item-has-children .sub-menu'
        );
        this.events();
    }

    events() {
        this.searchIcon.on('click', e => {
            this.showSearch.call(this, e);
        });

        $(window).on('click', e => {
            this.searchCheckClick.call(this, e);
        });

        $(document).on('keydown', this.keyPressDispatcher.bind(this));
    }

    // Methods

    searchCheckClick(e) {
        const target = $(e.target);
        if (
            !target.is('.nav-search__icon') &&
            !target.parents('.nav-search__icon').length &&
            !target.is('#header-search') &&
            !target.parents('#header-search').length
        ) {
            this.hideSearch();
        }
    }

    showSearch(e) {
        if (e) e.preventDefault();
        if (!this.search.hasClass('active')) {
            this.hideSubnavs();
            this.search.fadeIn(400, () => {
                this.search.find('input').focus();
            });
            this.search.addClass('active');
        }

        return false;
    }

    hideSearch() {
        this.search.fadeOut(300, () => {
            this.search.removeClass('active');
        });
    }

    hideSubnavs() {
        this.subnavs.hide(0);
    }

    keyPressDispatcher(e) {
        if (
            e.keyCode == 83 &&
            !this.search.hasClass('active') &&
            !$('input, textarea').is(':focus')
        ) {
            this.showSearch();
        }
        if (e.keyCode == 27 && this.search.hasClass('active')) {
            this.hideSearch();
        }
    }
}

export default Search;
