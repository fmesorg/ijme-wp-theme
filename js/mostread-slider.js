jQuery(document).ready(function ($) {

  // $('.cust-carousel').slick({
  //                        slidesToShow: 4,
  //                        slidesToScroll: 2,
  //                        respondTo: 'cust-carousel',
  //                      });

  //Topic Carousel
  $('.topic-carousel').slick({
                               slidesToShow: 4,
                               slidesToScroll: 1,
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

  //Category Carousel
  $('.category-carousel').slick({
                                  slidesToShow: 4,
                                  slidesToScroll: 1,
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
});
