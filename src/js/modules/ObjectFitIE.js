import $ from 'jquery';

class ObjectFitIE {
    constructor() {
        this.userAgent = window.navigator.userAgent;
        this.ieReg = /msie|Trident.*rv[ :]*11\./gi;
        this.ie = this.ieReg.test(this.userAgent);

        this.images = $('.ie-object-fit');

        this.events();
    }

    events() {
        if(this.ie) {
            this.images.each(this.replaceImgWithBg);
        }
    }

    // Methods
    replaceImgWithBg() {
        var $container = $(this),
        imgUrl = $container.find("img").prop("src");
        if (imgUrl) {
            $container.css("backgroundImage", 'url(' + imgUrl + ')').addClass("ie-object-fit-fix");
        }
    }

}

export default ObjectFitIE