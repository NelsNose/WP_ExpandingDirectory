jQuery(document).ready(function () {
  jQuery('.directory-section').each(function (i) {
    if ((i + 2) % 2 === 0) {
      jQuery(this).addClass('one');
    }
/*    if ((i + 2) % 3 === 0) {
      jQuery(this).addClass('two');
    } */
    if ((i + 1) % 2 === 0) {
      jQuery(this).addClass('three');
    }
  });
});

function toggleDiv(divid) {
  var toggleId = '#' + divid + '-toggle';
  var wrapperId = '#' + divid + '-wrapper';
  var contentId = '#' + divid;
  var thisheight = jQuery(contentId).outerHeight(true);
  if (thisheight === 0) {
    thisheight = jQuery(contentId).innerHeight();
    thisheight = thisheight + 40;
  }
  if (thisheight === 0) {
    thisheight = jQuery(contentId).height();
    thisheight = thisheight + 40;
  }
  var contentHeight = thisheight + "px";
  var parentWidth = jQuery(wrapperId).parent().parent().innerWidth();
  if (parentWidth === 0) {
    parentWidth = jQuery(wrapperId).parent().parent().width();
  }
  if (jQuery(wrapperId).css("height") === "0px") {
    var newWidth;
    var offSet;
    jQuery('.expanded').each(function () {
       var wrapId = jQuery(this).attr('id');
       var id = wrapId.split('-');
       var autoId = '';
       var i = 0;
       while(i<id.length) {
         if (i === 0) {
           autoId = autoId + id[i];
         }
         if ((i > 0) && (id[i] !== 'toggle')) {
           autoId = autoId + '-' + id[i];
         }
         i+=1;
       }
       var autoToggleId = '#' + autoId + '-toggle';
       var autoWrapperId = '#' + autoId + '-wrapper';
       jQuery(autoWrapperId).css('overflow', 'hidden');
       jQuery(autoWrapperId).animate({height: "0px", width: '100%', left: 0});
       jQuery(autoToggleId).removeClass("expanded");
       jQuery(autoToggleId).addClass("collapsed");
    });
    if (jQuery(wrapperId).parent().hasClass("one")) {
      newWidth = jQuery(wrapperId).parent().parent().innerWidth();
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().width();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().innerWidth();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().width();
      }
      jQuery(wrapperId).animate({height: contentHeight, width: newWidth}, function () {jQuery(this).css('overflow', 'visible');});
      jQuery(toggleId).addClass("expanded");
      jQuery(toggleId).removeClass("collapsed");
    }
    if (jQuery(wrapperId).parent().hasClass("two")) {
      newWidth = jQuery(wrapperId).parent().parent().innerWidth();
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().width();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().innerWidth();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().width();
      }
      offSet = jQuery(wrapperId).parent().offset().left - jQuery(wrapperId).parent().parent().offset().left + "px";
      jQuery(wrapperId).animate({height: contentHeight, width: newWidth, left : '-' + (offSet)}, function () {jQuery(this).css('overflow', 'visible');});
      jQuery(toggleId).addClass("expanded");
      jQuery(toggleId).removeClass("collapsed");
    }
    if (jQuery(wrapperId).parent().hasClass("three")) {
      newWidth = jQuery(wrapperId).parent().parent().innerWidth();
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().width();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().innerWidth();
      }
      if (newWidth === 0) {
        newWidth = jQuery(wrapperId).parent().parent().parent().width();
      }
      offSet = jQuery(wrapperId).parent().offset().left - jQuery(wrapperId).parent().parent().offset().left + "px";
      jQuery(wrapperId).animate({height: contentHeight, width: newWidth, left : '-' + (offSet)}, function () {jQuery(this).css('overflow', 'visible');});
      jQuery(toggleId).addClass("expanded");
      jQuery(toggleId).removeClass("collapsed");
    }
  }
  else {
    jQuery(wrapperId).css('overflow', 'hidden');
    jQuery(wrapperId).animate({height: "0px", width: '100%', left: 0});
    jQuery(toggleId).removeClass("expanded");
    jQuery(toggleId).addClass("collapsed");
  }

jQuery('.directory-section').on('mouseenter', '.directory_item', function () {
  var tooltip = jQuery(this).find('.directory-item-tooltip');
  /* console.log('position: ' + tooltip.position().top + ', Pposition: ' + tooltip.parent().position().top);
console.log('offset: ' + tooltip.offset().top + ', Poffset: ' + tooltip.parent().offset().top);
console.log('height: ' + tooltip.height()); */
  tooltip.delay(333).animate({opacity: 'show', top: tooltip.parent().position().top + 'px', left: '2px'});
});

jQuery('.directory-section').on('mouseleave', '.directory_item', function () {
  var tooltip = jQuery(this).find('.directory-item-tooltip');
  var dirsectH = jQuery(this).innerHeight();
  var topAdj = dirsectH + "px";
  tooltip.stop(true);
  tooltip.animate({opacity: 'hide', top: topAdj});
});

}
