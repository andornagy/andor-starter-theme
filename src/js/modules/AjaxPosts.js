import $ from "jquery";

class AjaxPosts {
  constructor() {
    this.filter = $("#filters");
    this.response = $("#response");

    this.search = this.filter.find('[name="kw"], [name="title"]');
    this.previousValue;
    this.typingTimer;

    this.reset = this.filter.find(".reset");

    this.paginationChanged = false;
    this.pScrollBuffer = 50;

    this.events();
  }

  events() {
    this.filter
      .find(".filter__item")
      .on("change", this.changeFilter.bind(this));
    this.filter.submit((e) => this.processSubmit(e));

    // Keydown fires so fast, that it doesn't give the input enough time to update its value.
    this.search.on("keyup", this.typingLogic.bind(this));

    this.reset.on("click", this.resetFilter.bind(this));

    $(document).on("click", "#response .pagination a", (e) =>
      this.changePage(e)
    );
  }

  resetFilter() {
    // Set custom dropdowns to initial value
    let items = this.filter.find(".filter__item--reset");
    items.each(function () {
      let $this = $(this);
      $this.val("");
      // Set default value for custom select and hide dropdown
      // let resetText = $this.data('title') ? $this.data('title') : $this.children('option').eq(0).text();
      // $this.siblings('.select-custom__wrapper').text(resetText).removeClass('active');
      // $this.siblings('.select-custom__options').hide();
    });
    this.filter.find('[name="pg"]').val(1);

    // Change filter
    setTimeout(this.changeFilter.bind(this), 0);
    return false;
  }

  typingLogic() {
    if (this.search.val() != this.previousValue) {
      clearTimeout(this.typingTimer);
      this.typingTimer = setTimeout(this.changeFilter.bind(this), 750);
    }
    this.previousValue = this.search.val();
  }

  changePage(e) {
    e.preventDefault();
    let target = $(e.target);
    let num = target.attr("href").split("#").pop();
    if (num) {
      this.filter.find('[name="pg"]').val(num);
    }
    this.paginationChanged = true;
    this.doAjax();
  }

  changeFilter() {
    this.filter.find('[name="pg"]').val(1);
    setTimeout(this.doAjax.bind(this), 0);
  }

  processSubmit(e) {
    e.preventDefault();
    setTimeout(this.changeFilter.bind(this), 0);
  }

  doAjax() {
    const i = this.filter.serialize();
    if (this.filter && this.filter.length) {
      window.history.pushState("", "", "?" + i);
    }

    setTimeout(this.getResults.bind(this), 0);

    return false;
  }

  getResults() {
    $.ajax({
      url: themeData.ajax_url,
      data:
        this.filter.serialize() +
        "&nonce=" +
        themeData.ajax_nonce +
        "&action=process_ajax", // form data
      type: this.filter.attr("method"), // POST
      beforeSend: (xhr) => {
        this.filter.parents(".section").addClass("loading");
      },
      success: (response) => {
        this.filter.parents(".section").removeClass("loading");
        this.response.html(response); // insert data
        if (this.paginationChanged) {
          $("html").animate(
            {
              scrollTop:
                this.response.offset().top -
                $(".header__inner").innerHeight() -
                this.pScrollBuffer,
            },
            800
          );
          this.paginationChanged = false;
        }
      },
      error: (response) => {
        console.log(response);
      },
    });
  }
}

export default AjaxPosts;
