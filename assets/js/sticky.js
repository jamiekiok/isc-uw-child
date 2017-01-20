$(document).ready(function() {
  /* CODE FOR THE FLOATING MENU TO BE USED ON THE USER GUIDE TEMPLATE (CLASS float-menu) */
  // gathering the necessary elements we need
  var parent = $(".uw-body");
  var toc = $(".float-menu");
  var content = $(".float-content");
  var padding = toc.css("padding-left").slice(0, -2);
  var menu_percentage = (toc.width() + padding * 2) / $(".row").width();
  var width_change = 991; // the width at which the table of contents is simply put on top of the content

  // getting the point at which to start the floating mechanism
  // we need to calculate both the potential padding and width
  // of a floating toc
  var change = true;
  var pad_left = (content.offset().left - toc.width() - padding * 2);
  var parent_width = parent.width();
  var new_width = (parent_width * menu_percentage) + padding / 2;

  if($(window).width() > width_change && change) {
    var height_change = $(".float-menu").offset().top;
    change = false;
  }

  // There are two ways the user could potentially activate the
  // floating behavior, by resizing the page or by scrolling
  $(window).resize(function() {
    // by resizing the window, the width and padding of a potentially
    // floating toc changes, so we have to recalculate it
    parent_width = parent.width();
    new_width = (parent_width * menu_percentage) + padding / 2;
    pad_left = (content.offset().left - toc.width() - padding * 2);

    if($(this).width() > width_change && change) {
      // we don't wanna continually update this however, otherwise it will be wonky
      // the function is continually updating/implementing it's changes which causes a jumpy toc
      // just wanna get it once we have the opportunity and it should never change really...
      height_change = toc.offset().top;
      change = false;
    }
    // if a user resizes the page to activate the floating thingy, we have to be ready and
    // account for their location on the page
    if($(this).width() > width_change) {
      if($(this).scrollTop() > height_change) {
        toc.addClass("uw-accordion-menu-floater");
        content.addClass("uw-content-floater");
        toc.css("width", new_width);
        toc.css("left", pad_left);
      } else {
        toc.removeClass("uw-accordion-menu-floater");
        content.removeClass("uw-content-floater");
        toc.css({'width': ''});
        toc.css({'left': ''});
      }
    } else { // the case in which the page is expanded beyond 991px
      // we don't want to intefere with the behavior implemented in the css
      toc.removeClass("uw-accordion-menu-floater");
      content.removeClass("uw-content-floater");
      toc.css({'width': ''});
      toc.css({'left': ''});
    }
  });

  $(window).scroll(function() {
      // if the page is more than 991 px, it can follow the floating behavior
      if($(this).width() > width_change) {
        if($(this).scrollTop() > height_change) {
          toc.addClass("uw-accordion-menu-floater");
          content.addClass("uw-content-floater");
          toc.css("width", new_width);
          toc.css("left", pad_left);
        } else {
          toc.removeClass("uw-accordion-menu-floater");
          content.removeClass("uw-content-floater");
          toc.css({'width': ''});
          toc.css({'left': ''});
        }
    }
  });
});