/*
jQuery(document).ready(function($) {
    $('#pdfDownloadLink').click(function() {
        var that = this;
        _gaq.push(['_trackEvent', 'Download', 'PDF', this.href]);
        setTimeout(function() {
            location.href = that.href;
        }, 200);
        return false;
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
*/

 jQuery(function($){
   $(".submit_review > a").click(function(){
		$("#myModal").modal('show');
	});
});

jQuery(function($){
	var wh = $(window).width();
	$('body').attr('style', 'width:' + wh + 'px;');
});

//Document Ready JS to use
jQuery(document).ready(function($) {
  $('.topic-carousel').slick({
                           slidesToShow: 4,
                            slidesToScroll:1,
                               prevArrow: $('.topic-prev'),
                               nextArrow: $('.topic-next'),
                           responsive: [
                             {
                               breakpoint: 1024,
                               settings: {
                                 slidesToShow: 3,
                                 slidesToScroll: 3,
                               }
                             },
                             {
                               breakpoint: 600,
                               settings: {
                                 slidesToShow: 2,
                                 slidesToScroll: 2
                               }
                             },
                             {
                               breakpoint: 480,
                               settings: {
                                 slidesToShow: 1,
                                 slidesToScroll: 1
                               }
                             }
                           ]
                         });

  $('.category-carousel').slick({
                           slidesToShow: 4,
                            slidesToScroll:1,
                               prevArrow: $('.category-prev'),
                               nextArrow: $('.category-next'),
                           responsive: [
                             {
                               breakpoint: 1024,
                               settings: {
                                 slidesToShow: 3,
                                 slidesToScroll: 3,
                               }
                             },
                             {
                               breakpoint: 600,
                               settings: {
                                 slidesToShow: 2,
                                 slidesToScroll: 2
                               }
                             },
                             {
                               breakpoint: 480,
                               settings: {
                                 slidesToShow: 1,
                                 slidesToScroll: 1
                               }
                             }
                           ]
                         });


  $("#submitStart a").click(function(){
		return show_submission_closed_modal();
	});

  // js for search
  $('.search-icon').click(function(){
		$('.search-form').slideToggle("fast");
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
        content: "IJME is sustained by donation and voluntary payment of fees and subscription. If you can Afford to, please use our Pay What You Want (PWYW) system to pay a fee for the full-text access or pdf download of this article."
    });

    confirmBox.open();
}


function showCountryModal() {
    let countryBox = new jBox('Confirm',{
        confirmButton: 'Continue',
        cancelButton: 'Cancel',
        closeOnClick:"body",
        confirm: function () {
            window.open("/index/support/","_self");
        },
        cancel:function (){
            window.open("/index/subscribe/","_self");
        },
        closeButton:"box",
        content:"Currently we are able to accept support only from Indian Readers, Please continue if you are from India."
    });

    countryBox.open();
}

