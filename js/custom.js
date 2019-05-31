/*
$(document).ready(function() {
    $('#pdfDownloadLink').click(function() {
        var that = this;
        _gaq.push(['_trackEvent', 'Download', 'PDF', this.href]);
        setTimeout(function() {
            location.href = that.href;
        }, 200);
        return false;
    });
    $(".scroll-to-top").hide();
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });
        $('.scroll-to-top a').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
    if ($('#articleCitations')[0]) {
        var widgetHTML = $('#articleCitations').html();
        widgetHTML = widgetHTML.replace(/<p>/g, '<li>');
        widgetHTML = widgetHTML.replace(/<\/p>/g, '</li>');
        widgetHTML = widgetHTML.replace(/<div>/g, '<ol>');
        widgetHTML = widgetHTML.replace(/<\/div>/g, '</ol>')
        $('#articleCitations').html(widgetHTML);
    }
});
$(document).ready(function() {
    $(function() {
        $("a[rel='tooltip']").popover({
            trigger: "hover"
        });
    });
});
*/



jQuery(document).ready(function($) {	

    // Dropdown toggle
    $('.dropdown-toggle').click(function(){
    $(this).next('.dropdown-menu').toggle();
    });

    $(document).click(function(e) {
    var target = e.target;
    if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
    $('.dropdown-menu').hide();
    }
    });

    // Add ads banner on sidebar of home page
    if (window.location.pathname == '/'){ 
        // $('#sidebar').prepend('<a class="sidebar-ads-banner" target="_blank" href="http://www.ethics.edu.in/yu-fic.html"><img src="http://ijme.in/wp-content/uploads/2018/03/YUFIC-Feature-box-Mar-Apr-2018_final.jpg"></a>') 
    }

});

 jQuery(function($){
   $(".submit_review > a").click(function(){
		$("#myModal").modal('show');
	});
});

jQuery(function($){
	var wh = $(window).width();
	$('body').attr('style', 'width:' + wh + 'px;');
}); 

jQuery(document).ready(function($) {
	
	jQuery(".scroll-to-top").hide();
	
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('.scroll-to-top').fadeIn();
		} else {
			jQuery('.scroll-to-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	jQuery('.scroll-to-top a').click(function() {
		jQuery('body,html').animate({
			scrollTop : 0
		}, 800);
		return false;
	});
	
	
    $('.dropdown').hover(function() {
        $(this).addClass('open');
    }, function() {
        $(this).removeClass('open');
    });
	
	
	var width = $('.ticker-text').width(),
    containerwidth = $('.ticker-container').width(),
    left = containerwidth;
	
	function tick() {
        if(--left <= -width){
            left = containerwidth;
        }
        $(".ticker-text").css("margin-left", left + "px");
        myTimeOut = setTimeout(tick, 10);
      }
      $('.ticker-text').mouseout( function () {
        myTimeOut = setTimeout(tick, 10)
      });
     $('.ticker-text').mouseover( function () {
        clearTimeout(myTimeOut);
      });
     
      tick();
	
	
	$(".disable-state > a").attr('title', 'Sorry, we are in the process of migrating the IJME \n Archives data to our new site. This issue should \n be available soon. Please visit www.ijme.in again!');
	
	$("#submitStart a").click(function(){
		return show_submission_closed_modal();
	});
	
	// js for accordian
    function toggleIcon(e) {
        jQuery(e.target)
            .prev('.panel-heading')
            .find(".more-less")
            .toggleClass('glyphicon-plus glyphicon-minus');
    }
    jQuery('.panel-group').on('hidden.bs.collapse', toggleIcon);
    jQuery('.panel-group').on('shown.bs.collapse', toggleIcon);
	
	// js for search
	
	$('.search-icon').click(function(){
		$('.search-form').slideToggle("fast");
	});
	
	var owl = $("#carousel");
	owl.owlCarousel({
	autoPlay : 3000, //Set AutoPlay to 3 seconds
	items : 2,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3],
	pagination : false,
	loop:true,
    autoWidth: false,
	singleItem:false
	});

});

function show_submission_closed_modal() {
    $('#submission-closed-modal').modal();
	return false;
}

function hideBox() {
    document.getElementById("paymentFooterContainer").style.display="none";
}

function showSupportModal(url) {
    let confirmBox = new jBox('Confirm',{
        confirmButton: 'Pay Now',
        cancelButton: 'Later',
        closeOnClick:"body",
        confirm: function () {
            let paymentUrl = "/IjmeFeesCollectionApp/index.php?refrer_url="+url;
            window.open(paymentUrl,"_self");
        },
        cancel: function () {
            window.location = url;
        },
        closeButton:"box",
        content: "[Text to be changed] Please Support us to continue publishing such articles."
    });

    confirmBox.open();
}


function showCountryModal() {
    let countryBox = new jBox('Confirm',{
        confirmButton: 'Continue',
        cancelButton: 'Cancel',
        closeOnClick:"body",
        confirm: function () {
            window.open("https://www.payumoney.com/paybypayumoney/#/322913");
        },
        closeButton:"box",
        content:"[Text to be changed] Currently we are able to accept support only from Indian Readers, If you are Indian please click continue."
    }).open();
}