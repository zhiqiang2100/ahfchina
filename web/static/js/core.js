;(function($){

    $.fn.placeholder = function (param) {
    if('placeholder' in document.createElement('input') || this.length == 0) return this;

    var defaults = {}, opts = $.extend({}, defaults, param);

    return this.each(function() {
      var $this = $(this),
      placeholder = $this.attr('placeholder');

      if($this.val() == '') $this.val(placeholder);

      $this
      .off('focus.holder blur.holder click.holder')
      .on('focus.holder blur.holder click.holder', function(e) {
        switch (e.type) {
        case 'focus':
        if ($.trim($this.val()) == placeholder)
        $this.val('');
        break;
        case 'blur':
        if ($.trim($this.val()) == '')
        $this.val(placeholder);
        break;
        default:
        }
        });
    });
    }

    $('input[placeholder]').placeholder();

}(jQuery));
