(function($){
  $.iphoneStyle = {
    defaults: { checkedLabel: 'ON', uncheckedLabel: 'OFF', background: '#fff' }
  }
  function getIndx(bool) {
      if(bool) {
          return 1;
      } else {
          return 0;
      }
  }
  $.fn.iphoneStyle = function(options) {
    options = $.extend($.iphoneStyle.defaults, options);
    
    return this.each(function() {
      var elem = $(this);
      
      if (!elem.is(':checkbox'))
        return;
      
      elem.css({ opacity: 0 });
      elem.wrap('<div class="iphone-container" />');
      elem.after('<div class="iphone-handle"><div class="iphone-bg" style="background: ' + options.background + '"/><div class="iphone-slider" /></div>')
          .after('<label class="iphone-off">'+ options.uncheckedLabel + '</label>')
          .after('<label class="iphone-on">' + options.checkedLabel   + '</label>');
      
      var handle    = elem.siblings('.iphone-handle'),
          handlebg  = handle.children('.iphone-bg'),
          offlabel  = elem.siblings('.iphone-off'),
          onlabel   = elem.siblings('.iphone-on'),
          container = elem.parent('.iphone-container'),
          rightside = container.width() - 39;
      
      container.click(function() {
        var is_onstate = (handle.position().left <= 0);
            new_left   = (is_onstate) ? rightside : 0,
            bgleft     = (is_onstate) ? 34 : 0;

        handlebg.hide();
        handle.animate({ left: new_left }, 100, function() {
          handlebg.css({ left: bgleft }).show();
        });
        
        if (is_onstate) {
          offlabel.animate({ opacity: 0 }, 200);
          onlabel.animate({ opacity: 1 }, 200);
        } else {
          offlabel.animate({ opacity: 1 }, 200);
          onlabel.animate({ opacity: 0 }, 200);
        }
        
        elem.prop('checked', !is_onstate);
        $('input[name="'+elem.prop('id')+'"]').prop('value', getIndx(is_onstate));
        return false;
      });
      
      // initial load
      if (elem.is(':checked')) {
        offlabel.css({ opacity: 0 });
        onlabel.css({ opacity: 1 });
        handle.css({ left: rightside });
        handlebg.css({ left: 34 });
      }
    });
  };
})(jQuery);