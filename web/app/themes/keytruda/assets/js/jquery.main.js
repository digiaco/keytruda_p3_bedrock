var voted = false;
jQuery(document).ready(function () {

  jQuery(".banner .text-hold h1").dotdotdot({
    fallbackToLetter: true,
    watch: true,
    tolerance: 5
  });

  let tabs = jQuery('.tabs:not(.not-active)');
  tabs.tabslet();

  smoothScrolling();
  jQuery('#branding nav li.menu-item-has-children > a').append('<span class="sep"></span>');
  bodyBoxes();
  tabsExtendedUrls();
  jQuery('a[href="#safety"]').on('click', function () {
    popupDisplay();
  });
  dropDownScroll();
  popupDisplayCheck();
  jumpTabs();
  jQuery('a.popup-btn').fancybox({
    touch: false,
  });
  mobileNav();
  setFormActionDownloadUrl();
  assistive_box();
  menuAccessibility();
  bottomTogler();
  jQuery(window).resize();
  accordionToggle();
  keynoteScrollOpen();
  dosingByIndicationScrollOpen();
  patientProfileScrollOpen();
  hashScrolling();
  jQuery('a#skip-link').on('click', function () {
    jQuery('#container').focus();
  });
  setTimeout(function () {
    starRating();
  }, 500);

  jQuery('a[href$=".pdf"]').attr('target', '_blank');
  jQuery('a[href$=".pdf"]').attr('rel', 'noopener noreferrer');
  /*
  jQuery('.star').click(function() {
    jQuery(this).addClass('selected');
    jQuery(this).prevAll().addClass('selected');
    jQuery(this).nextAll().removeClass('selected');
    return false;
  });
  */
  jQuery(document).on('afterClose.fb', function (e, instance, slide) {
    jQuery('#onetrust-banner-sdk').removeClass('fixed');
    jQuery('.safety-popup').removeClass('visible');
  });

  jQuery('.vertical-table').each(function () {
    var $sections = jQuery(this).find('.table-hold');
    $sections.on('scroll', function () {
      var $this = jQuery(this),
        scrollLeft = $this.scrollLeft();
      $sections.not($this).scrollLeft(scrollLeft);
    });
  })
  jQuery(document).bind('gform_post_render', function () {
    jQuery('.register-popup#reg-popup select').selectric();
    jQuery('.gfield input').on('click', function () {
      jQuery(this).parent().parent().removeClass('gfield_error');
      jQuery(this).parent().parent().find('.validation_message').remove();
    });
    jQuery('.gfield input').on('change', function () {
      jQuery(this).parent().parent().removeClass('gfield_error');
      jQuery(this).parent().parent().find('.validation_message').remove();
    });
    jQuery('.validation_message').on('click', function () {
      jQuery(this).parent().removeClass('gfield_error');
      jQuery(this).remove();
    });
    jQuery('.selectric').on('click', function () {
      jQuery(this).parent().parent().parent().removeClass('gfield_error');
      jQuery(this).parent().parent().parent().find('.validation_message').remove();
    });
    jQuery('.gfield input[type="checkbox"],.gfield input[type="radio"]').on('change', function () {
      jQuery(this).parent().parent().parent().parent().removeClass('gfield_error');
      jQuery(this).parent().parent().parent().parent().find('.validation_message').remove();
    })
    jQuery('.gfield select').on('change', function () {
      jQuery(this).parent().parent().parent().removeClass('gfield_error');
      jQuery(this).parent().parent().parent().find('.validation_message').remove();
    });
  });
  jQuery(document).on('gform_confirmation_loaded', function (event, formId) {
    jQuery('body').addClass('thanks-loaded');
    if (formId == 2) {
      setCookie('already_voted', 'true', 30);
      setCookie('my_score', jQuery('.rating .star.selected:last').data('value'), 30);
      jQuery('.rating').removeClass('not-voted');
      voted = true;
    }
  });
  if (getCookie('already_voted') == 'true' && getCookie('my_score')) {
    jQuery('.rating').removeClass('not-voted');
    jQuery('.rating .star[data-value="' + getCookie('my_score') + '"]').addClass('selected');
    jQuery('.rating .star[data-value="' + getCookie('my_score') + '"]').prevAll().addClass('selected');
  }

});

var accordionButtons = jQuery('.accordion-controls li button');
function accordionToggle() {

  jQuery('.accordion-controls li button').on('click', function (e) {
    $control = jQuery(this);
    accordionContent = $control.attr('aria-controls');
    checkOthers($control[0]);

    isAriaExp = $control.attr('aria-expanded');
    newAriaExp = (isAriaExp == "false") ? "true" : "false";
    $control.attr('aria-expanded', newAriaExp);

    isAriaHid = jQuery('#' + accordionContent).attr('aria-hidden');
    if (isAriaHid == "true") {
      jQuery('#' + accordionContent).attr('aria-hidden', "false");
      jQuery('#' + accordionContent).slideDown(350);
    } else {
      jQuery('#' + accordionContent).attr('aria-hidden', "true");
      jQuery('#' + accordionContent).slideUp(350);
    }
  });
};

function starRating() {
  jQuery('.rating.not-voted .star').hover(function () {
    if (voted == false) {
      jQuery(this).addClass('hover');
      jQuery(this).prevAll().addClass('hover');
    }
  }, function () {
    if (voted == false) {
      jQuery(this).removeClass('hover');
      jQuery(this).prevAll().removeClass('hover');
    }
  });
  jQuery('.rating.not-voted .star').click(function () {
    if (voted == false) {
      jQuery.fancybox.open({
        src: '#thanks',
        type: 'inline',
        touch: false,
      });
    }
  });
  jQuery('.rating.not-voted .star').click(function () {
    if (voted == false) {
      var cur = jQuery(this).data('value');
      jQuery(this).addClass('selected');
      jQuery(this).prevAll().addClass('selected');
      jQuery(this).nextAll().removeClass('selected');
      jQuery('#thanks .star[data-value="' + cur + '"]').addClass('selected');
      jQuery('#thanks .star[data-value="' + cur + '"]').prevAll().addClass('selected');
      jQuery('#thanks .star[data-value="' + cur + '"]').nextAll().removeClass('selected');
      jQuery('.rating-field input').val(jQuery('#thanks .star.selected:last').data('value'));
    }
    return false;
  });


}

function checkOthers(elem) {
  for (var i = 0; i < accordionButtons.length; i++) {
    if (accordionButtons[i] != elem) {
      if ((jQuery(accordionButtons[i]).attr('aria-expanded')) == 'true') {
        jQuery(accordionButtons[i]).attr('aria-expanded', 'false');
        content = jQuery(accordionButtons[i]).attr('aria-controls');
        jQuery('#' + content).attr('aria-hidden', 'true');
        jQuery('#' + content).slideUp(350);
      }
    }
  }
};

function smoothScrolling() {
  jQuery('a[href*="#"]:not([href="#"],.tabs ul a)').not('a[href="#safety"],.indicator-selector .indicator-selector-wrp .indicator-item,.indicator-dropdown ul a,.trial-content a').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      if (target.length) {
        jQuery('html, body').animate({
          scrollTop: target.offset().top - 200
        }, 1000);
        return false;
      }
    }
  });
}

function keynoteScrollOpen() {
  if (jQuery('body').hasClass('page-template-page-study-results')) {
    let tabs = jQuery('.tabs:not(.not-active)');
    if (window.location.hash) {
      // Get the anchor value
      var anchor = window.location.hash.substring(1);
      if (anchor && anchor !== '') {
        let tabAnchor = 0;
        let anchorString = anchor;
        let anchorLevels = anchor.split('/');
        if (anchorLevels && anchorLevels.length >= 2) {
          anchorString = anchorLevels[0];
          if (anchorLevels[1] === 'efficacy-results') {
            tabAnchor = 1;
          } else if (anchorLevels[1] === 'safety-profile') {
            tabAnchor = 2;
          }
        }
        setTimeout(function () {
          jQuery('html, body').animate({
            scrollTop: jQuery('#' + anchorString).offset().top - 50
          }, 1000);
        }, 1000);
        setTimeout(function () {
          jQuery('li#' + anchorString + ' button').trigger('click');
          tabs.find('li').eq(tabAnchor).find('a').trigger('click');
        }, 2000);

      }
    }
  }
}

function dosingByIndicationScrollOpen() {
  if (jQuery('body').hasClass('page-template-page-dosing-faq')) {
    if (window.location.hash) {
      var anchor = window.location.hash.substring(1);
      if (anchor && anchor !== '') {
        let anchorString = anchor;
        let anchorLevels = anchor.split('/');
        if (anchorLevels && anchorLevels.length >= 2) {
          anchorString = anchorLevels[0];
        }
        setTimeout(function () {
          jQuery('li#' + anchorString + ' button').trigger('click');
        }, 1000);
      }
    }
  }
}

function patientProfileScrollOpen() {
  if (jQuery('body').hasClass('page-template-page-patient')) {
    if (window.location.hash) {
      var anchor = window.location.hash.substring(1);
      if (anchor && anchor !== '') {
        let anchorString = anchor;
        let anchorLevels = anchor.split('/');
        if (anchorLevels && anchorLevels.length >= 2) {
          anchorString = anchorLevels[0];
        }
        if (jQuery('.tabset li#' + anchorString + ' a').length > 0) {
          setTimeout(function () {
            jQuery('.tabset li#' + anchorString + ' a').trigger('click');
          }, 1000);
        }
      }
    }
  }
}

function hashScrolling() {
  if (window.location.hash) {
    // Get the anchor value
    var anchor = window.location.hash.substring(1);
    let anchorString = anchor;
    if (anchor && anchor !== '') {
      let anchorLevels = anchor.split('/');
      if (anchorLevels && anchorLevels.length >= 2) {
        anchorString = anchorLevels[0];
      }
    }

    let scrollEl = jQuery('#' + anchorString);
    if (scrollEl.length > 0) {
      setTimeout(function () {
        jQuery('html, body').animate({
          scrollTop: scrollEl.offset().top - 50
        }, 1000);
      }, 1000);
    }
  }
}

function tabsExtendedUrls() {

  jQuery('.trial-content ul.tabset.inside li a').on('click', function () {
    var el = jQuery(this),
      link_attr = el.attr('href');

    setTimeout(function () {
      var highestBox = 0;
      jQuery(link_attr + ' .main-circle p.circle-title').each(function () {
        if (jQuery(this).height() > highestBox) {
          highestBox = jQuery(this).height();
        }
      });
      jQuery(link_attr + ' .main-circle p.circle-title').height(highestBox);
    }, 400);
  });

}

function dropDownScroll() {
  jQuery('.indicator-dropdown ul li a').each(function () {
    var btn = jQuery(this),
      box = btn.data('box');

    btn.on('click', function () {
      setTimeout(function () {
        jQuery('html, body').animate({
          scrollTop: jQuery('#' + box).offset().top - 550
        }, 500);
      }, 300);
      jQuery('.indicator-dropdown ul').slideUp(300);
      jQuery('.indicator-dropdown span.heading').removeClass('active');
    });
    btn.on('keydown', function (e) {
      if (e.which == 13) {
        jQuery('.indicator-item.' + box).trigger('click');
        jQuery('.indicator-dropdown ul').slideUp(300);
        jQuery('.indicator-dropdown span.heading').removeClass('active');

      }
    });
  });
}

function bodyBoxes() {
  var indicator_btn = jQuery('.indicator-dropdown > span.heading'),
    list = jQuery('.indicator-dropdown > ul');

  indicator_btn.on('click', function () {
    if (indicator_btn.hasClass('active')) {
      indicator_btn.removeClass('active');
      list.slideUp(350);
    }
    else {
      indicator_btn.addClass('active');
      list.slideDown(350);
    }
    jQuery('.body-box').fadeOut(300);
    jQuery('.body-box').removeClass('active');
  });


  indicator_btn.on('keydown', function (e) {
    if (e.which == 13) {
      if (indicator_btn.hasClass('active')) {
        indicator_btn.removeClass('active');
        list.slideUp(350);
      }
      else {
        indicator_btn.addClass('active');
        list.slideDown(350);
      }

    }
  });

  jQuery('.indicator-dropdown ul li:last-child a').focusout(function () {
    indicator_btn.removeClass('active');
    list.slideUp(350);
  });

  jQuery('.indicator-selector-wrp > a').each(function () {
    var btn = jQuery(this),
      target = btn.data('box');

    jQuery('.body-box').each(function () {
      var box = jQuery(this),
        btns_hold = jQuery(this).find('.btns-hold'),
        box_section = box.attr('id'),
        close = box.find('.close');

      btn.on('click', function () {
        jQuery('.indicator-dropdown ul').slideUp(300);
        jQuery('.indicator-dropdown span.heading').removeClass('active');
        jQuery('.indicator-selector-wrp > a').removeClass('active');
        jQuery('.indicator-item.ec .img-wrp').removeClass('special-active');
        btn.addClass('active');
        if (btn.hasClass('mmr-ec')) {
          jQuery('.indicator-item.ec .img-wrp').addClass('special-active');
        }

        box.fadeOut(300);
        box.removeClass('active');
        if (target == box_section) {
          jQuery('.indicator-dropdown ul a').removeClass('active');
          jQuery('.indicator-dropdown ul a[data-box="' + box_section + '"]').addClass('active');
          setTimeout(function () {
            box.fadeIn(300);
            box.addClass('active');

          }, 200);
          setTimeout(function () {
            if (jQuery(window).width() < 600) {
              jQuery('html, body').animate({
                scrollTop: jQuery('#' + target).offset().top - 300
              }, 500);
            } else {
              jQuery('html, body').animate({
                scrollTop: jQuery('#' + target).offset().top - 550
              }, 500);
            }

          }, 300);
          setTimeout(function () {
            btns_hold.find('a.btn:first-child').focus();
          }, 500);
        }
        return false;
      });

      close.on('click', function () {
        box.fadeOut(300);
        box.removeClass('active');
        jQuery('.indicator-selector-wrp > a').removeClass('active');
        jQuery('.indicator-item.ec .img-wrp').removeClass('special-active');
        jQuery('.indicator-dropdown span.heading').focus();
        return false;
      })

      list.find('a').each(function () {
        var item = jQuery(this),
          item_box = item.data('box');

        item.mouseover(function () {
          if (item_box == target) {
            jQuery('.indicator-selector-wrp > a').removeClass('active');
            btn.addClass('active');
          }
        });

        item.on('click', function () {
          box.fadeOut(300);
          box.removeClass('active');
          jQuery('.indicator-dropdown ul a').removeClass('active');
          item.addClass('active');
          if (item_box == box_section) {
            setTimeout(function () {
              box.fadeIn(300);
              box.addClass('active');
              btns_hold.find('a.btn:first-child').focus();
            }, 200);
          }
          return false;
        });
      });
    });
  });
  jQuery('.indicator-item.mmr-ec .img-description').on('mouseover', function () {
    jQuery('.indicator-item.ec .img-wrp').addClass('special-hover');
  });
  jQuery('.indicator-item.mmr-ec .img-description').on('mouseleave', function () {
    jQuery('.indicator-item.ec .img-wrp').removeClass('special-hover');
  });
  jQuery('.body-box.a.active a.btn').last().focusout(function () {
    jQuery('.body-box span.close').focus();
  });
}

function menuAccessibility() {
  jQuery('#main-nav li.menu-item-has-children').each(function () {
    var el = jQuery(this),
      main_link = el.find(' > a'),
      list = el.find('ul.sub-menu');
    list.find('a').attr
    main_link.on('keydown', function (e) {
      if (e.which == 13 || e.which == 40) {
        jQuery('#branding nav ul li.menu-item-has-children .sub-menu').removeClass('focus-active');
        list.find('li').first().find('a').focus().addClass('focus-now');
        list.addClass('focus-active');
      }
    });
    main_link.parent().next().find('> a').on('focus', function () {
      list.removeClass('focus-active');
    });
  });
  jQuery('.to-top a,.all-to-top').on('keydown', function (e) {
    if (e.which == 13) {
      setTimeout(function () {
        jQuery('a#skip-link').focus();
      }, 300);
    }
  });
}

let OPERATING_SYSTEMS = {
  WINDOWS: 'Windows',
  MACOSX: 'Mac OS X',
  WINDOWS_PHONE: 'Windows Phone',
  WINDOWS_RT: 'Windows RT',
  IOS: 'iOS',
  ANDROID: 'Android',
  LINUX: 'Linux',
  UNKNOWN: 'Unknown'
}

let assistive_box = function () {
  let close = jQuery('.assistive .form-box span.close'),
    form_box = jQuery('.assistive .form-box'),
    assistive_btn = jQuery('.assistive > img');

  assistive_btn.on('click', function () {
    if (form_box.hasClass('active')) {
      form_box.removeClass('active');
      form_box.fadeOut(300);
    } else {
      form_box.addClass('active');
      form_box.fadeIn(300);
    }
  });
  assistive_btn.on('keydown', function (e) {
    if (e.which == 13) {
      if (form_box.hasClass('active')) {
        form_box.removeClass('active');
        form_box.fadeOut(300);
        jQuery('.assistive .form-box button')
      } else {
        form_box.addClass('active');
        form_box.fadeIn(300);
      }
    }
  });
  close.on('keydown', function (e) {
    if (e.which == 13) {
      form_box.removeClass('active');
      form_box.fadeOut(300);
    }
  });
  close.on('click', function () {
    form_box.removeClass('active');
    form_box.fadeOut(300);
  })
}

let getOsName = function () {
  var win = /(windows|win32)/i;
  var winrt = / arm;/i;
  var winphone = /windows\sphone\s\d+\.\d+/i;
  var osx = /(macintosh|mac os x)/i;
  var ios = /(iPad|iPhone|iPod)(?=.*like Mac OS X)/i;
  var linux = /(linux|joli|[kxln]?ubuntu|debian|[open]*suse|gentoo|arch|slackware|fedora|mandriva|centos|pclinuxos|redhat|zenwalk)/i;
  var android = /android/i;

  if (window.navigator.userAgent.match(winphone)) {
    return OPERATING_SYSTEMS.WINDOWS_PHONE;
  }
  if (window.navigator.userAgent.match(winrt)) {
    return OPERATING_SYSTEMS.WINDOWS_RT;
  }
  if (window.navigator.userAgent.match(ios)) {
    return OPERATING_SYSTEMS.IOS;
  }
  if (window.navigator.userAgent.match(android)) {
    return OPERATING_SYSTEMS.ANDROID;
  }
  if (window.navigator.userAgent.match(linux)) {
    return OPERATING_SYSTEMS.LINUX;
  }
  if (window.navigator.userAgent.match(osx)) {
    return OPERATING_SYSTEMS.MACOSX;
  }
  if (window.navigator.userAgent.match(win)) {
    return OPERATING_SYSTEMS.WINDOWS;
  }

  return OPERATING_SYSTEMS.UNKNOWN;
}


let setFormActionDownloadUrl = function () {
  let installATform = Array.prototype.slice.call(document.querySelectorAll('[data-download-button-form]'), 0);

  function addAction(formElement) {
    console.log(getOsName());
    switch (getOsName()) {
      case OPERATING_SYSTEMS.WINDOWS:
        formElement.action = formElement.dataset.downloadUrlWindows;

        break;

      case OPERATING_SYSTEMS.MACOSX:
        formElement.action = formElement.dataset.downloadUrlMacos;
        break;

      case OPERATING_SYSTEMS.ANDROID:
        formElement.action = formElement.dataset.downloadUrlAndroid;
        break;
    }
  }

  installATform.forEach(addAction);
}



function mobileNav() {
  var mobile = false;
  jQuery(window).on('resize', function () {
    if (jQuery(window).width() <= 1023) {
      mobile = true;
    }
    else {
      mobile = false;
    }
  });

  var btn = jQuery('span.mobile-btn'),
    list = jQuery('#branding nav .content-wrapper'),
    bottom_list = jQuery('#branding ul.bottom-nav');

  btn.click(function () {
    if (btn.hasClass('active')) {
      btn.removeClass('active');
      list.slideUp(300);
      jQuery('body').removeClass('mobile-open');
    }
    else {
      btn.addClass('active');
      jQuery('body').addClass('mobile-open');
      list.slideDown(300);
    }
  });

  jQuery('#branding nav ul li.menu-item-has-children > a').each(function () {
    var sub_btn = jQuery(this),
      sub_list = sub_btn.next();

    sub_btn.on('click', function () {
      if (mobile == true) {
        if (sub_btn.hasClass('active')) {
          sub_btn.removeClass('active');
          sub_list.slideUp(300);
        }
        else {
          sub_btn.addClass('active');
          sub_list.slideDown(300);
        }
      }
    });

  })
}

function jumpTabs() {
  jQuery('.bottom-buttons a').each(function () {
    var el = jQuery(this),
      target = el.attr('href');
    el.on('click', function () {
      if (target.includes("first")) {
        setTimeout(function () {
          jQuery('.tabset.inside li:first-child a').trigger('click');
        }, 300);

        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target_link = jQuery(this.hash),
            target_title = el.parent().parent().parent().prev().outerHeight();
          //target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
          if (target_link.length) {
            jQuery('html, body').animate({
              scrollTop: target_link.offset().top - target_title - 70
            }, 1000);
            return false;
          }
        }


      }
      if (target.includes("second")) {
        setTimeout(function () {
          jQuery('.tabset.inside li:nth-child(2) a').trigger('click');
        }, 300);
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target_link = jQuery(this.hash),
            target_title = el.parent().parent().parent().prev().outerHeight();
          //target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
          if (target_link.length) {
            jQuery('html, body').animate({
              scrollTop: target_link.offset().top - target_title - 70
            }, 1000);
            return false;
          }
        }
      }
      if (target.includes("third")) {
        setTimeout(function () {
          jQuery('.tabset.inside li:nth-child(3) a').trigger('click');
        }, 300);
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target_link = jQuery(this.hash),
            target_title = el.parent().parent().parent().prev().outerHeight();
          //target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
          if (target_link.length) {
            jQuery('html, body').animate({
              scrollTop: target_link.offset().top - target_title - 70
            }, 1000);
            return false;
          }
        }
      }
    })
  })
}

// OneTrust adjustions
var check_again = 0;
var check_stop = false;

function popupDisplayCheck() {
  var check_popup = getCookie('popup_show');
  if (check_popup != 'true') {
    popupDisplay();
    setCookie('popup_show', 'true', 7);
  }
}
function popupDisplay() {
  jQuery('a.safety-p').trigger('click');
  jQuery('a.safety-p').on('click', function () {
    jQuery('.safety-popup').addClass('visible');
  })
  if (check_stop === true) {
    jQuery('#onetrust-banner-sdk').addClass('fixed');
  }
}

function popupHeight() {
  var popup = jQuery('.safety-popup');
  var popup_container = popup.find('.hold');
  var popup_heading = popup.find('.heading');
  var window_h = jQuery(window).height();
  var banner_h = jQuery('#onetrust-banner-sdk').outerHeight();
  var wpadminbar_h = 0;
  if (jQuery('#wpadminbar').length > 0) {
    wpadminbar_h = jQuery('#wpadminbar').outerHeight();
  }
  var padding_top_bot = 100;
  if (jQuery(window).width() >= 767 && !jQuery('body').hasClass('ot-saved')) {
    var maxHeight = window_h - wpadminbar_h - banner_h - padding_top_bot - popup_heading.outerHeight();
    if (maxHeight < 400) {
      maxHeight = 400;
    }
    popup_container.css('max-height', maxHeight + 'px');
    popup.css('margin-top', banner_h + wpadminbar_h + 'px');
    jQuery('.safety-popup').addClass('visible');
  }
  else {
    popup_container.css('max-height', '100%');
    popup.css('margin-top', '0px');
    jQuery('.safety-popup').addClass('visible');
  }
}



//get the number of `<script>` elements that have the correct `src` attribute
var len = jQuery('script').filter(function () {
  return (jQuery(this).attr('src') == 'https://cdn.cookielaw.org/scripttemplates/otSDKStub.js');
}).length;

function timeoutBanner() {
  check_again++;
  // console.log('checking if Banner exists - ' + check_again);
  jQuery('body').addClass('ot-loaded')
  if (jQuery('#onetrust-banner-sdk').length > 0) {
    var banner_h = jQuery('#onetrust-banner-sdk').outerHeight();
    if (banner_h > 0 && banner_h != undefined && banner_h != null) {
      check_stop = true;
      console.log('Banner existing')

      // do stuff
      if (jQuery('.safety-popup').hasClass('visible')) {
        jQuery('#onetrust-banner-sdk').addClass('fixed');
      }
      popupHeight();
      jQuery(window).on('resize', function () {
        popupHeight();
      });

    } else {
      console.log('Banner is not existing')
    }
  }
  if (check_again < 20 && check_stop == false) {
    setTimeout(timeoutBanner, 200);
  }
}

//if there are no scripts that match, then load it
if (len > 0) {
  // check_stop = true;
  setTimeout(timeoutBanner, 200);
} else {
  console.log('Can not find otSDKStub script on page')
  setTimeout(timeoutBanner, 200);
}

jQuery(document).on("click", '#onetrust-accept-btn-handler, .save-preference-btn-handler.onetrust-close-btn-handler', function (e) {
  jQuery('body').addClass('ot-saved');
  jQuery('#onetrust-banner-sdk').removeClass('fixed');
  popupHeight();
});



function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
function eraseCookie(name) {
  document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function bottomTogler() {
  jQuery('.dosing-list .el').each(function () {
    var el = jQuery(this),
      btn = jQuery(this).find('.opener'),
      toggle = jQuery(this).find('.toggle-cont');

    btn.on('click', function () {
      if (btn.hasClass('active')) {
        btn.removeClass('active');
        toggle.slideUp(300);
      } else {
        btn.addClass('active');
        toggle.slideDown(300);
      }
      return false;
    });
  });
}



/* Custom Select */
(function (factory) {
  /* global define */
  /* istanbul ignore next */
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = function (root, jQuery) {
      if (jQuery === undefined) {
        if (typeof window !== 'undefined') {
          jQuery = require('jquery');
        } else {
          jQuery = require('jquery')(root);
        }
      }
      factory(jQuery);
      return jQuery;
    };
  } else {
    // Browser globals
    factory(jQuery);
  }
}(function ($) {
  'use strict';

  var $doc = $(document);
  var $win = $(window);

  var pluginName = 'selectric';
  var classList = 'Input Items Open Disabled TempShow HideSelect Wrapper Focus Hover Responsive Above Below Scroll Group GroupLabel';
  var eventNamespaceSuffix = '.sl';

  var chars = ['a', 'e', 'i', 'o', 'u', 'n', 'c', 'y'];
  var diacritics = [
    /[\xE0-\xE5]/g, // a
    /[\xE8-\xEB]/g, // e
    /[\xEC-\xEF]/g, // i
    /[\xF2-\xF6]/g, // o
    /[\xF9-\xFC]/g, // u
    /[\xF1]/g,      // n
    /[\xE7]/g,      // c
    /[\xFD-\xFF]/g  // y
  ];

  /**
   * Create an instance of Selectric
   *
   * @constructor
   * @param {Node} element - The &lt;select&gt; element
   * @param {object}  opts - Options
   */
  var Selectric = function (element, opts) {
    var _this = this;

    _this.element = element;
    _this.$element = $(element);

    _this.state = {
      multiple: !!_this.$element.attr('multiple'),
      enabled: false,
      opened: false,
      currValue: -1,
      selectedIdx: -1,
      highlightedIdx: -1
    };

    _this.eventTriggers = {
      open: _this.open,
      close: _this.close,
      destroy: _this.destroy,
      refresh: _this.refresh,
      init: _this.init
    };

    _this.init(opts);
  };

  Selectric.prototype = {
    utils: {
      /**
       * Detect mobile browser
       *
       * @return {boolean}
       */
      isMobile: function () {
        return /android|ip(hone|od|ad)/i.test(navigator.userAgent);
      },

      /**
       * Escape especial characters in string (https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions)
       *
       * @param  {string} str - The string to be escaped
       * @return {string}       The string with the special characters escaped
       */
      escapeRegExp: function (str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); // $& means the whole matched string
      },

      /**
       * Replace diacritics
       *
       * @param  {string} str - The string to replace the diacritics
       * @return {string}       The string with diacritics replaced with ascii characters
       */
      replaceDiacritics: function (str) {
        var k = diacritics.length;

        while (k--) {
          str = str.toLowerCase().replace(diacritics[k], chars[k]);
        }

        return str;
      },

      /**
       * Format string
       * https://gist.github.com/atesgoral/984375
       *
       * @param  {string} f - String to be formated
       * @return {string}     String formated
       */
      format: function (f) {
        var a = arguments; // store outer arguments
        return ('' + f) // force format specifier to String
          .replace( // replace tokens in format specifier
            /\{(?:(\d+)|(\w+))\}/g, // match {token} references
            function (
              s, // the matched string (ignored)
              i, // an argument index
              p // a property name
            ) {
              return p && a[1] // if property name and first argument exist
                ? a[1][p] // return property from first argument
                : a[i]; // assume argument index and return i-th argument
            });
      },

      /**
       * Get the next enabled item in the options list.
       *
       * @param  {object} selectItems - The options object.
       * @param  {number}    selected - Index of the currently selected option.
       * @return {object}               The next enabled item.
       */
      nextEnabledItem: function (selectItems, selected) {
        while (selectItems[selected = (selected + 1) % selectItems.length].disabled) {
          // empty
        }
        return selected;
      },

      /**
       * Get the previous enabled item in the options list.
       *
       * @param  {object} selectItems - The options object.
       * @param  {number}    selected - Index of the currently selected option.
       * @return {object}               The previous enabled item.
       */
      previousEnabledItem: function (selectItems, selected) {
        while (selectItems[selected = (selected > 0 ? selected : selectItems.length) - 1].disabled) {
          // empty
        }
        return selected;
      },

      /**
       * Transform camelCase string to dash-case.
       *
       * @param  {string} str - The camelCased string.
       * @return {string}       The string transformed to dash-case.
       */
      toDash: function (str) {
        return str.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
      },

      /**
       * Calls the events registered with function name.
       *
       * @param {string}    fn - The name of the function.
       * @param {number} scope - Scope that should be set on the function.
       */
      triggerCallback: function (fn, scope) {
        var elm = scope.element;
        var func = scope.options['on' + fn];
        var args = [elm].concat([].slice.call(arguments).slice(1));

        if ($.isFunction(func)) {
          func.apply(elm, args);
        }

        $(elm).trigger(pluginName + '-' + this.toDash(fn), args);
      },

      /**
       * Transform array list to concatenated string and remove empty values
       * @param  {array} arr - Class list
       * @return {string}      Concatenated string
       */
      arrayToClassname: function (arr) {
        var newArr = $.grep(arr, function (item) {
          return !!item;
        });

        return $.trim(newArr.join(' '));
      }
    },

    /** Initializes */
    init: function (opts) {
      var _this = this;

      // Set options
      _this.options = $.extend(true, {}, $.fn[pluginName].defaults, _this.options, opts);

      _this.utils.triggerCallback('BeforeInit', _this);

      // Preserve data
      _this.destroy(true);

      // Disable on mobile browsers
      if (_this.options.disableOnMobile && _this.utils.isMobile()) {
        _this.disableOnMobile = true;
        return;
      }

      // Get classes
      _this.classes = _this.getClassNames();

      // Create elements
      var input = $('<input/>', { 'class': _this.classes.input, 'readonly': _this.utils.isMobile() });
      var items = $('<div/>', { 'class': _this.classes.items, 'tabindex': -1 });
      var itemsScroll = $('<div/>', { 'class': _this.classes.scroll });
      var wrapper = $('<div/>', { 'class': _this.classes.prefix, 'html': _this.options.arrowButtonMarkup });
      var label = $('<span/>', { 'class': 'label' });
      var outerWrapper = _this.$element.wrap('<div/>').parent().append(wrapper.prepend(label), items, input);
      var hideSelectWrapper = $('<div/>', { 'class': _this.classes.hideselect });

      _this.elements = {
        input: input,
        items: items,
        itemsScroll: itemsScroll,
        wrapper: wrapper,
        label: label,
        outerWrapper: outerWrapper
      };

      if (_this.options.nativeOnMobile && _this.utils.isMobile()) {
        _this.elements.input = undefined;
        hideSelectWrapper.addClass(_this.classes.prefix + '-is-native');

        _this.$element.on('change', function () {
          _this.refresh();
        });
      }

      _this.$element
        .on(_this.eventTriggers)
        .wrap(hideSelectWrapper);

      _this.originalTabindex = _this.$element.prop('tabindex');
      _this.$element.prop('tabindex', -1);

      _this.populate();
      _this.activate();

      _this.utils.triggerCallback('Init', _this);
    },

    /** Activates the plugin */
    activate: function () {
      var _this = this;
      var hiddenChildren = _this.elements.items.closest(':visible').children(':hidden').addClass(_this.classes.tempshow);
      var originalWidth = _this.$element.width();

      hiddenChildren.removeClass(_this.classes.tempshow);

      _this.utils.triggerCallback('BeforeActivate', _this);

      _this.elements.outerWrapper.prop('class',
        _this.utils.arrayToClassname([
          _this.classes.wrapper,
          _this.$element.prop('class').replace(/\S+/g, _this.classes.prefix + '-$&'),
          _this.options.responsive ? _this.classes.responsive : ''
        ])
      );

      if (_this.options.inheritOriginalWidth && originalWidth > 0) {
        _this.elements.outerWrapper.width(originalWidth);
      }

      _this.unbindEvents();

      if (!_this.$element.prop('disabled')) {
        _this.state.enabled = true;

        // Not disabled, so... Removing disabled class
        _this.elements.outerWrapper.removeClass(_this.classes.disabled);

        // Remove styles from items box
        // Fix incorrect height when refreshed is triggered with fewer options
        _this.$li = _this.elements.items.removeAttr('style').find('li');

        _this.bindEvents();
      } else {
        _this.elements.outerWrapper.addClass(_this.classes.disabled);

        if (_this.elements.input) {
          _this.elements.input.prop('disabled', true);
        }
      }

      _this.utils.triggerCallback('Activate', _this);
    },

    /**
     * Generate classNames for elements
     *
     * @return {object} Classes object
     */
    getClassNames: function () {
      var _this = this;
      var customClass = _this.options.customClass;
      var classesObj = {};

      $.each(classList.split(' '), function (i, currClass) {
        var c = customClass.prefix + currClass;
        classesObj[currClass.toLowerCase()] = customClass.camelCase ? c : _this.utils.toDash(c);
      });

      classesObj.prefix = customClass.prefix;

      return classesObj;
    },

    /** Set the label text */
    setLabel: function () {
      var _this = this;
      var labelBuilder = _this.options.labelBuilder;

      if (_this.state.multiple) {
        // Make sure currentValues is an array
        var currentValues = $.isArray(_this.state.currValue) ? _this.state.currValue : [_this.state.currValue];
        // I'm not happy with this, but currentValues can be an empty
        // array and we need to fallback to the default option.
        currentValues = currentValues.length === 0 ? [0] : currentValues;

        var labelMarkup = $.map(currentValues, function (value) {
          return $.grep(_this.lookupItems, function (item) {
            return item.index === value;
          })[0]; // we don't want nested arrays here
        });

        labelMarkup = $.grep(labelMarkup, function (item) {
          // Hide default (please choose) if more then one element were selected.
          // If no option value were given value is set to option text by default
          if (labelMarkup.length > 1 || labelMarkup.length === 0) {
            return $.trim(item.value) !== '';
          }
          return item;
        });

        labelMarkup = $.map(labelMarkup, function (item) {
          return $.isFunction(labelBuilder)
            ? labelBuilder(item)
            : _this.utils.format(labelBuilder, item);
        });

        // Limit the amount of selected values shown in label
        if (_this.options.multiple.maxLabelEntries) {
          if (labelMarkup.length >= _this.options.multiple.maxLabelEntries + 1) {
            labelMarkup = labelMarkup.slice(0, _this.options.multiple.maxLabelEntries);
            labelMarkup.push(
              $.isFunction(labelBuilder)
                ? labelBuilder({ text: '...' })
                : _this.utils.format(labelBuilder, { text: '...' }));
          } else {
            labelMarkup.slice(labelMarkup.length - 1);
          }
        }
        _this.elements.label.html(labelMarkup.join(_this.options.multiple.separator));

      } else {
        var currItem = _this.lookupItems[_this.state.currValue];

        _this.elements.label.html(
          $.isFunction(labelBuilder)
            ? labelBuilder(currItem)
            : _this.utils.format(labelBuilder, currItem)
        );
      }
    },

    /** Get and save the available options */
    populate: function () {
      var _this = this;
      var $options = _this.$element.children();
      var $justOptions = _this.$element.find('option');
      var $selected = $justOptions.filter(':selected');
      var selectedIndex = $justOptions.index($selected);
      var currIndex = 0;
      var emptyValue = (_this.state.multiple ? [] : 0);

      if ($selected.length > 1 && _this.state.multiple) {
        selectedIndex = [];
        $selected.each(function () {
          selectedIndex.push($(this).index());
        });
      }

      _this.state.currValue = (~selectedIndex ? selectedIndex : emptyValue);
      _this.state.selectedIdx = _this.state.currValue;
      _this.state.highlightedIdx = _this.state.currValue;
      _this.items = [];
      _this.lookupItems = [];

      if ($options.length) {
        // Build options markup
        $options.each(function (i) {
          var $elm = $(this);

          if ($elm.is('optgroup')) {

            var optionsGroup = {
              element: $elm,
              label: $elm.prop('label'),
              groupDisabled: $elm.prop('disabled'),
              items: []
            };

            $elm.children().each(function (i) {
              var $elm = $(this);

              optionsGroup.items[i] = _this.getItemData(currIndex, $elm, optionsGroup.groupDisabled || $elm.prop('disabled'));

              _this.lookupItems[currIndex] = optionsGroup.items[i];

              currIndex++;
            });

            _this.items[i] = optionsGroup;

          } else {

            _this.items[i] = _this.getItemData(currIndex, $elm, $elm.prop('disabled'));

            _this.lookupItems[currIndex] = _this.items[i];

            currIndex++;

          }
        });

        _this.setLabel();
        _this.elements.items.append(_this.elements.itemsScroll.html(_this.getItemsMarkup(_this.items)));
      }
    },

    /**
     * Generate items object data
     * @param  {integer} index      - Current item index
     * @param  {node}    $elm       - Current element node
     * @param  {boolean} isDisabled - Current element disabled state
     * @return {object}               Item object
     */
    getItemData: function (index, $elm, isDisabled) {
      var _this = this;

      return {
        index: index,
        element: $elm,
        value: $elm.val(),
        className: $elm.prop('class'),
        text: $elm.html(),
        slug: $.trim(_this.utils.replaceDiacritics($elm.html())),
        alt: $elm.attr('data-alt'),
        selected: $elm.prop('selected'),
        disabled: isDisabled
      };
    },

    /**
     * Generate options markup
     *
     * @param  {object} items - Object containing all available options
     * @return {string}         HTML for the options box
     */
    getItemsMarkup: function (items) {
      var _this = this;
      var markup = '<ul>';

      if ($.isFunction(_this.options.listBuilder) && _this.options.listBuilder) {
        items = _this.options.listBuilder(items);
      }

      $.each(items, function (i, elm) {
        if (elm.label !== undefined) {

          markup += _this.utils.format('<ul class="{1}"><li class="{2}">{3}</li>',
            _this.utils.arrayToClassname([
              _this.classes.group,
              elm.groupDisabled ? 'disabled' : '',
              elm.element.prop('class')
            ]),
            _this.classes.grouplabel,
            elm.element.prop('label')
          );

          $.each(elm.items, function (i, elm) {
            markup += _this.getItemMarkup(elm.index, elm);
          });

          markup += '</ul>';

        } else {

          markup += _this.getItemMarkup(elm.index, elm);

        }
      });

      return markup + '</ul>';
    },

    /**
     * Generate every option markup
     *
     * @param  {number} index    - Index of current item
     * @param  {object} itemData - Current item
     * @return {string}            HTML for the option
     */
    getItemMarkup: function (index, itemData) {
      var _this = this;
      var itemBuilder = _this.options.optionsItemBuilder;
      // limit access to item data to provide a simple interface
      // to most relevant options.
      var filteredItemData = {
        value: itemData.value,
        text: itemData.text,
        slug: itemData.slug,
        index: itemData.index
      };

      return _this.utils.format('<li data-index="{1}" class="{2}">{3}</li>',
        index,
        _this.utils.arrayToClassname([
          itemData.className,
          index === _this.items.length - 1 ? 'last' : '',
          itemData.disabled ? 'disabled' : '',
          itemData.selected ? 'selected' : ''
        ]),
        $.isFunction(itemBuilder)
          ? _this.utils.format(itemBuilder(itemData, this.$element, index), itemData)
          : _this.utils.format(itemBuilder, filteredItemData)
      );
    },

    /** Remove events on the elements */
    unbindEvents: function () {
      var _this = this;

      _this.elements.wrapper
        .add(_this.$element)
        .add(_this.elements.outerWrapper)
        .add(_this.elements.input)
        .off(eventNamespaceSuffix);
    },

    /** Bind events on the elements */
    bindEvents: function () {
      var _this = this;

      _this.elements.outerWrapper.on('mouseenter' + eventNamespaceSuffix + ' mouseleave' + eventNamespaceSuffix, function (e) {
        $(this).toggleClass(_this.classes.hover, e.type === 'mouseenter');

        // Delay close effect when openOnHover is true
        if (_this.options.openOnHover) {
          clearTimeout(_this.closeTimer);

          if (e.type === 'mouseleave') {
            _this.closeTimer = setTimeout($.proxy(_this.close, _this), _this.options.hoverIntentTimeout);
          } else {
            _this.open();
          }
        }
      });

      // Toggle open/close
      _this.elements.wrapper.on('click' + eventNamespaceSuffix, function (e) {
        _this.state.opened ? _this.close() : _this.open(e);
      });

      // Translate original element focus event to dummy input.
      // Disabled on mobile devices because the default option list isn't
      // shown due the fact that hidden input gets focused
      if (!(_this.options.nativeOnMobile && _this.utils.isMobile())) {
        _this.$element.on('focus' + eventNamespaceSuffix, function () {
          _this.elements.input.focus();
        });

        _this.elements.input
          .prop({ tabindex: _this.originalTabindex, disabled: false })
          .on('keydown' + eventNamespaceSuffix, $.proxy(_this.handleKeys, _this))
          .on('focusin' + eventNamespaceSuffix, function (e) {
            _this.elements.outerWrapper.addClass(_this.classes.focus);

            // Prevent the flicker when focusing out and back again in the browser window
            _this.elements.input.one('blur', function () {
              _this.elements.input.blur();
            });

            if (_this.options.openOnFocus && !_this.state.opened) {
              _this.open(e);
            }
          })
          .on('focusout' + eventNamespaceSuffix, function () {
            _this.elements.outerWrapper.removeClass(_this.classes.focus);
          })
          .on('input propertychange', function () {
            var val = _this.elements.input.val();
            var searchRegExp = new RegExp('^' + _this.utils.escapeRegExp(val), 'i');

            // Clear search
            clearTimeout(_this.resetStr);
            _this.resetStr = setTimeout(function () {
              _this.elements.input.val('');
            }, _this.options.keySearchTimeout);

            if (val.length) {
              // Search in select options
              $.each(_this.items, function (i, elm) {
                if (elm.disabled) {
                  return;
                }
                if (searchRegExp.test(elm.text) || searchRegExp.test(elm.slug)) {
                  _this.highlight(i);
                  return false;
                }
                if (!elm.alt) {
                  return;
                }
                var altItems = elm.alt.split('|');
                for (var ai = 0; ai < altItems.length; ai++) {
                  if (!altItems[ai]) {
                    break;
                  }
                  if (searchRegExp.test(altItems[ai].trim())) {
                    _this.highlight(i);
                    return false;
                  }
                }
              });
            }
          });
      }

      _this.$li.on({
        // Prevent <input> blur on Chrome
        mousedown: function (e) {
          e.preventDefault();
          e.stopPropagation();
        },
        click: function () {
          _this.select($(this).data('index'));

          // Chrome doesn't close options box if select is wrapped with a label
          // We need to 'return false' to avoid that
          return false;
        }
      });
    },

    /**
     * Behavior when keyboard keys is pressed
     *
     * @param {object} e - Event object
     */
    handleKeys: function (e) {
      var _this = this;
      var key = e.which;
      var keys = _this.options.keys;

      var isPrevKey = $.inArray(key, keys.previous) > -1;
      var isNextKey = $.inArray(key, keys.next) > -1;
      var isSelectKey = $.inArray(key, keys.select) > -1;
      var isOpenKey = $.inArray(key, keys.open) > -1;
      var idx = _this.state.highlightedIdx;
      var isFirstOrLastItem = (isPrevKey && idx === 0) || (isNextKey && (idx + 1) === _this.items.length);
      var goToItem = 0;

      // Enter / Space
      if (key === 13 || key === 32) {
        e.preventDefault();
      }

      // If it's a directional key
      if (isPrevKey || isNextKey) {
        if (!_this.options.allowWrap && isFirstOrLastItem) {
          return;
        }

        if (isPrevKey) {
          goToItem = _this.utils.previousEnabledItem(_this.lookupItems, idx);
        }

        if (isNextKey) {
          goToItem = _this.utils.nextEnabledItem(_this.lookupItems, idx);
        }

        _this.highlight(goToItem);
      }

      // Tab / Enter / ESC
      if (isSelectKey && _this.state.opened) {
        _this.select(idx);

        if (!_this.state.multiple || !_this.options.multiple.keepMenuOpen) {
          _this.close();
        }

        return;
      }

      // Space / Enter / Left / Up / Right / Down
      if (isOpenKey && !_this.state.opened) {
        _this.open();
      }
    },

    /** Update the items object */
    refresh: function () {
      var _this = this;

      _this.populate();
      _this.activate();
      _this.utils.triggerCallback('Refresh', _this);
    },

    /** Set options box width/height */
    setOptionsDimensions: function () {
      var _this = this;

      // Calculate options box height
      // Set a temporary class on the hidden parent of the element
      var hiddenChildren = _this.elements.items.closest(':visible').children(':hidden').addClass(_this.classes.tempshow);
      var maxHeight = _this.options.maxHeight;
      var itemsWidth = _this.elements.items.outerWidth();
      var wrapperWidth = _this.elements.wrapper.outerWidth() - (itemsWidth - _this.elements.items.width());

      // Set the dimensions, minimum is wrapper width, expand for long items if option is true
      if (!_this.options.expandToItemText || wrapperWidth > itemsWidth) {
        _this.finalWidth = wrapperWidth;
      } else {
        // Make sure the scrollbar width is included
        _this.elements.items.css('overflow', 'scroll');

        // Set a really long width for _this.elements.outerWrapper
        _this.elements.outerWrapper.width(9e4);
        _this.finalWidth = _this.elements.items.width();
        // Set scroll bar to auto
        _this.elements.items.css('overflow', '');
        _this.elements.outerWrapper.width('');
      }

      _this.elements.items.width(_this.finalWidth).height() > maxHeight && _this.elements.items.height(maxHeight);

      // Remove the temporary class
      hiddenChildren.removeClass(_this.classes.tempshow);
    },

    /** Detect if the options box is inside the window */
    isInViewport: function () {
      var _this = this;

      if (_this.options.forceRenderAbove === true) {
        _this.elements.outerWrapper.addClass(_this.classes.above);
      } else if (_this.options.forceRenderBelow === true) {
        _this.elements.outerWrapper.addClass(_this.classes.below);
      } else {
        var scrollTop = $win.scrollTop();
        var winHeight = $win.height();
        var uiPosX = _this.elements.outerWrapper.offset().top;
        var uiHeight = _this.elements.outerWrapper.outerHeight();

        var fitsDown = (uiPosX + uiHeight + _this.itemsHeight) <= (scrollTop + winHeight);
        var fitsAbove = (uiPosX - _this.itemsHeight) > scrollTop;

        // If it does not fit below, only render it
        // above it fit's there.
        // It's acceptable that the user needs to
        // scroll the viewport to see the cut off UI
        var renderAbove = !fitsDown && fitsAbove;
        var renderBelow = !renderAbove;

        _this.elements.outerWrapper.toggleClass(_this.classes.above, renderAbove);
        _this.elements.outerWrapper.toggleClass(_this.classes.below, renderBelow);
      }
    },

    /**
     * Detect if currently selected option is visible and scroll the options box to show it
     *
     * @param {Number|Array} index - Index of the selected items
     */
    detectItemVisibility: function (index) {
      var _this = this;
      var $filteredLi = _this.$li.filter('[data-index]');

      if (_this.state.multiple) {
        // If index is an array, we can assume a multiple select and we
        // want to scroll to the uppermost selected item!
        // Math.min.apply(Math, index) returns the lowest entry in an Array.
        index = ($.isArray(index) && index.length === 0) ? 0 : index;
        index = $.isArray(index) ? Math.min.apply(Math, index) : index;
      }

      var liHeight = $filteredLi.eq(index).outerHeight();
      var liTop = $filteredLi[index].offsetTop;
      var itemsScrollTop = _this.elements.itemsScroll.scrollTop();
      var scrollT = liTop + liHeight * 2;

      _this.elements.itemsScroll.scrollTop(
        scrollT > itemsScrollTop + _this.itemsHeight ? scrollT - _this.itemsHeight :
          liTop - liHeight < itemsScrollTop ? liTop - liHeight :
            itemsScrollTop
      );
    },

    /**
     * Open the select options box
     *
     * @param {Event} e - Event
     */
    open: function (e) {
      var _this = this;

      if (_this.options.nativeOnMobile && _this.utils.isMobile()) {
        return false;
      }

      _this.utils.triggerCallback('BeforeOpen', _this);

      if (e) {
        e.preventDefault();
        if (_this.options.stopPropagation) {
          e.stopPropagation();
        }
      }

      if (_this.state.enabled) {
        _this.setOptionsDimensions();

        // Find any other opened instances of select and close it
        $('.' + _this.classes.hideselect, '.' + _this.classes.open).children()[pluginName]('close');

        _this.state.opened = true;
        _this.itemsHeight = _this.elements.items.outerHeight();
        _this.itemsInnerHeight = _this.elements.items.height();

        // Toggle options box visibility
        _this.elements.outerWrapper.addClass(_this.classes.open);

        // Give dummy input focus
        _this.elements.input.val('');
        if (e && e.type !== 'focusin') {
          _this.elements.input.focus();
        }

        // Delayed binds events on Document to make label clicks work
        setTimeout(function () {
          $doc
            .on('click' + eventNamespaceSuffix, $.proxy(_this.close, _this))
            .on('scroll' + eventNamespaceSuffix, $.proxy(_this.isInViewport, _this));
        }, 1);

        _this.isInViewport();

        // Prevent window scroll when using mouse wheel inside items box
        if (_this.options.preventWindowScroll) {
          /* istanbul ignore next */
          $doc.on('mousewheel' + eventNamespaceSuffix + ' DOMMouseScroll' + eventNamespaceSuffix, '.' + _this.classes.scroll, function (e) {
            var orgEvent = e.originalEvent;
            var scrollTop = $(this).scrollTop();
            var deltaY = 0;

            if ('detail' in orgEvent) { deltaY = orgEvent.detail * -1; }
            if ('wheelDelta' in orgEvent) { deltaY = orgEvent.wheelDelta; }
            if ('wheelDeltaY' in orgEvent) { deltaY = orgEvent.wheelDeltaY; }
            if ('deltaY' in orgEvent) { deltaY = orgEvent.deltaY * -1; }

            if (scrollTop === (this.scrollHeight - _this.itemsInnerHeight) && deltaY < 0 || scrollTop === 0 && deltaY > 0) {
              e.preventDefault();
            }
          });
        }

        _this.detectItemVisibility(_this.state.selectedIdx);

        _this.highlight(_this.state.multiple ? -1 : _this.state.selectedIdx);

        _this.utils.triggerCallback('Open', _this);
      }
    },

    /** Close the select options box */
    close: function () {
      var _this = this;

      _this.utils.triggerCallback('BeforeClose', _this);

      // Remove custom events on document
      $doc.off(eventNamespaceSuffix);

      // Remove visible class to hide options box
      _this.elements.outerWrapper.removeClass(_this.classes.open);

      _this.state.opened = false;

      _this.utils.triggerCallback('Close', _this);
    },

    /** Select current option and change the label */
    change: function () {
      var _this = this;

      _this.utils.triggerCallback('BeforeChange', _this);

      if (_this.state.multiple) {
        // Reset old selected
        $.each(_this.lookupItems, function (idx) {
          _this.lookupItems[idx].selected = false;
          _this.$element.find('option').prop('selected', false);
        });

        // Set new selected
        $.each(_this.state.selectedIdx, function (idx, value) {
          _this.lookupItems[value].selected = true;
          _this.$element.find('option').eq(value).prop('selected', true);
        });

        _this.state.currValue = _this.state.selectedIdx;

        _this.setLabel();

        _this.utils.triggerCallback('Change', _this);
      } else if (_this.state.currValue !== _this.state.selectedIdx) {
        // Apply changed value to original select
        _this.$element
          .prop('selectedIndex', _this.state.currValue = _this.state.selectedIdx)
          .data('value', _this.lookupItems[_this.state.selectedIdx].text);

        // Change label text
        _this.setLabel();

        _this.utils.triggerCallback('Change', _this);
      }
    },

    /**
     * Highlight option
     * @param {number} index - Index of the options that will be highlighted
     */
    highlight: function (index) {
      var _this = this;
      var $filteredLi = _this.$li.filter('[data-index]').removeClass('highlighted');

      _this.utils.triggerCallback('BeforeHighlight', _this);

      // Parameter index is required and should not be a disabled item
      if (index === undefined || index === -1 || _this.lookupItems[index].disabled) {
        return;
      }

      $filteredLi
        .eq(_this.state.highlightedIdx = index)
        .addClass('highlighted');

      _this.detectItemVisibility(index);

      _this.utils.triggerCallback('Highlight', _this);
    },

    /**
     * Select option
     *
     * @param {number} index - Index of the option that will be selected
     */
    select: function (index) {
      var _this = this;
      var $filteredLi = _this.$li.filter('[data-index]');

      _this.utils.triggerCallback('BeforeSelect', _this, index);

      // Parameter index is required and should not be a disabled item
      if (index === undefined || index === -1 || _this.lookupItems[index].disabled) {
        return;
      }

      if (_this.state.multiple) {
        // Make sure selectedIdx is an array
        _this.state.selectedIdx = $.isArray(_this.state.selectedIdx) ? _this.state.selectedIdx : [_this.state.selectedIdx];

        var hasSelectedIndex = $.inArray(index, _this.state.selectedIdx);
        if (hasSelectedIndex !== -1) {
          _this.state.selectedIdx.splice(hasSelectedIndex, 1);
        } else {
          _this.state.selectedIdx.push(index);
        }

        $filteredLi
          .removeClass('selected')
          .filter(function (index) {
            return $.inArray(index, _this.state.selectedIdx) !== -1;
          })
          .addClass('selected');
      } else {
        $filteredLi
          .removeClass('selected')
          .eq(_this.state.selectedIdx = index)
          .addClass('selected');
      }

      if (!_this.state.multiple || !_this.options.multiple.keepMenuOpen) {
        _this.close();
      }

      _this.change();

      _this.utils.triggerCallback('Select', _this, index);
    },

    /**
     * Unbind and remove
     *
     * @param {boolean} preserveData - Check if the data on the element should be removed too
     */
    destroy: function (preserveData) {
      var _this = this;

      if (_this.state && _this.state.enabled) {
        _this.elements.items.add(_this.elements.wrapper).add(_this.elements.input).remove();

        if (!preserveData) {
          _this.$element.removeData(pluginName).removeData('value');
        }

        _this.$element.prop('tabindex', _this.originalTabindex).off(eventNamespaceSuffix).off(_this.eventTriggers).unwrap().unwrap();

        _this.state.enabled = false;
      }
    }
  };

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function (args) {
    return this.each(function () {
      var data = $.data(this, pluginName);

      if (data && !data.disableOnMobile) {
        (typeof args === 'string' && data[args]) ? data[args]() : data.init(args);
      } else {
        $.data(this, pluginName, new Selectric(this, args));
      }
    });
  };

  /**
   * Default plugin options
   *
   * @type {object}
   */
  $.fn[pluginName].defaults = {
    onChange: function (elm) { $(elm).change(); },
    maxHeight: 300,
    keySearchTimeout: 500,
    arrowButtonMarkup: '<b class="button">&#x25be;</b>',
    disableOnMobile: false,
    nativeOnMobile: true,
    openOnFocus: true,
    openOnHover: false,
    hoverIntentTimeout: 500,
    expandToItemText: false,
    responsive: false,
    preventWindowScroll: true,
    inheritOriginalWidth: false,
    allowWrap: true,
    forceRenderAbove: false,
    forceRenderBelow: false,
    stopPropagation: true,
    optionsItemBuilder: '{text}', // function(itemData, element, index)
    labelBuilder: '{text}', // function(currItem)
    listBuilder: false,    // function(items)
    keys: {
      previous: [37, 38],                 // Left / Up
      next: [39, 40],                 // Right / Down
      select: [9, 13, 27],              // Tab / Enter / Escape
      open: [13, 32, 37, 38, 39, 40], // Enter / Space / Left / Up / Right / Down
      close: [9, 27]                   // Tab / Escape
    },
    customClass: {
      prefix: pluginName,
      camelCase: false
    },
    multiple: {
      separator: ', ',
      keepMenuOpen: true,
      maxLabelEntries: false
    }
  };
}));
