VimpPageComponent = {

  max_width: 740,

  slider: null,

  overwriteResetButton: function (name, url) {
    $('input[name="cmd[resetFilter]"]')
      .replaceWith('<a class="btn btn-default" href="' + url + '">' + name + '</a>');
  },

  initForm: function () {
    VimpPageComponent.slider = $('#vpco_slider')
      .data('ionRangeSlider');
    VimpPageComponent.updateSlider();

    $('input#prop_size_width')
      .change(function () {
        let new_width = $(this)
          .val();
        let new_height = $('#vpco_thumbnail')
          .height();
        if (VimpPageComponent.keepAspectRatio()) {
          let current_width = $('#vpco_thumbnail')
            .width();
          let current_height = $('#vpco_thumbnail')
            .height();
          let ratio = (current_width / current_height);
          new_height = Math.round(new_width / ratio);
          $('#vpco_thumbnail')
            .height(new_height);
          $('input#prop_size_height')
            .val(new_height);
        }
        $('#vpco_thumbnail')
          .width(new_width);
        VimpPageComponent.updateSlider();
        VimpPageComponent.updateRatio(new_width, new_height);
      });

    $('input#prop_size_height')
      .change(function () {
        let new_height = $(this)
          .val();
        let new_width = $('#vpco_thumbnail')
          .width();
        if (VimpPageComponent.keepAspectRatio()) {
          let current_width = $('#vpco_thumbnail')
            .width();
          let current_height = $('#vpco_thumbnail')
            .height();
          let ratio = (current_width / current_height);
          new_width = Math.round(new_height * ratio);
          $('#vpco_thumbnail')
            .width(new_width);
          $('input#prop_size_width')
            .val(new_width);
          VimpPageComponent.updateSlider();
        }
        $('#vpco_thumbnail')
          .height(new_height);
        VimpPageComponent.updateRatio(new_width, new_height);
      });
  },

  updateRatio: function (width, height) {
    $('#desc_size')
      .html(VimpPageComponent.getAspectRatio(width, height));
  },

  updateSlider: function () {
    let width = $('input#prop_size_width')
      .val();
    let percentage = (width / VimpPageComponent.max_width) * 100;
    VimpPageComponent.slider.update({ from: percentage });
  },

  sliderCallback: function (data) {
    let current_width = $('#vpco_thumbnail')
      .width();
    let current_height = $('#vpco_thumbnail')
      .height();
    let ratio = (current_width / current_height);
    let percentage = data.from;

    let new_width = Math.round(VimpPageComponent.max_width * (percentage / 100));
    let new_height = Math.round((new_width / ratio));

    $('#vpco_thumbnail')
      .width(new_width);
    $('input#prop_size_width')
      .val(new_width);
    $('#vpco_thumbnail')
      .height(new_height);
    $('input#prop_size_height')
      .val(new_height);
    VimpPageComponent.updateRatio(new_width, new_height);
  },

  getAspectRatio: function (width, height) {
    let greatestCommonDivisor = function (width, height) {
      return (width % height) ? greatestCommonDivisor(height, width % height) : height;
    };

    let divisor = greatestCommonDivisor(width, height);

    return width / divisor + '/' + height / divisor;
  },

  keepAspectRatio: function () {
    return $('input#prop_size_constr')
      .is(':checked');
  },
};
