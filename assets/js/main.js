(function($) {
    "use strict";
    $(window).on('load', function() {
        $('#preloader').fadeOut();
        $(window).on('scroll', function(event) {
            var scroll = $(window).scrollTop();
            if (scroll < 20) {
                $(".navbar-area").removeClass("sticky");
            } else {
                $(".navbar-area").addClass("sticky");
            }
        });
        $('.page-scroll').click(function() {
            var hash = this.hash;
            var position = $(hash).offset().top - 60;
            $('html').animate({
                scrollTop: position
            }, 900);
        });
        var scrollLink = $('.page-scroll');
        $(window).scroll(function() {
            var scrollbarLocation = $(this).scrollTop();
            scrollLink.each(function() {
                if ($(this.hash).offset()) {
                    var sectionOffset = $(this.hash).offset().top - 73;
                    if (sectionOffset <= scrollbarLocation) {
                        $(this).parent().addClass('active');
                        $(this).parent().siblings().removeClass('active');
                    }
                }
            });
        });

        $(".navbar-nav a").on('click', function() {
            $(".navbar-collapse").removeClass("show");
        });
        $(".navbar-toggler").on('click', function() {
            $(this).toggleClass("active");
        });
        $(".navbar-nav a").on('click', function() {
            $(".navbar-toggler").removeClass('active');
        });
        var wow = new WOW({
            mobile: false
        });
        wow.init();

        var owl = $("#testimonials");
        owl.owlCarousel({
            loop: true,
            nav: true,
            navText: ["<i class='lni lni-arrow-left'></i>", "<i class='lni lni-arrow-right'></i>"],
            dots: false,
            center: true,
            margin: 16,
            slideSpeed: 1000,
            stopOnHover: true,
            autoPlay: true,
            autoplayTimeout: 1000,
            responsiveClass: true,
            responsiveRefreshRate: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
        var rfidOwl = $("#rfid_testimonials");
        rfidOwl.owlCarousel({
            loop: true,
            nav: true,
            navText: ["<i class='lni lni-arrow-left'></i>", "<i class='lni lni-arrow-right'></i>"],
            dots: false,
            center: true,
            margin: 16,
            autoPlay: true,
            autoplayTimeout: 1000,
            responsiveClass: true,
            responsiveRefreshRate: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
        var supportArticles = $("#supportArticles");
        supportArticles.owlCarousel({
            loop: false,
            nav: true,
            navText: ["<i class='lni lni-chevron-left'></i>", "<i class='lni lni-chevron-right'></i>"],
            dots: true,
            center: true,
            margin: 15,
            slideSpeed: 1000,
            stopOnHover: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
        var articles = $(".articles");
        articles.owlCarousel({
            loop: false,
            nav: true,
            navText: ["<i class='lni lni-chevron-left'></i>", "<i class='lni lni-chevron-right'></i>"],
            dots: true,
            margin: 16,
            slideSpeed: 1000,
            stopOnHover: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                960: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1920: {
                    items: 4
                }
            }
        });
        
        $(".back-to-top").click(function() {
            $("html,body").animate({
                scrollTop: 0
            }, 1000);
        });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 180) {
                $(".back-to-top").fadeIn();
            } else {
                $(".back-to-top").fadeOut();
            }
        });

        $("#txtSearchIndustry").on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#industrySearch .item-box").each(function() {
                if ($(this).text().toLowerCase().search(value) > -1) {
                    $(this).show();
                    $(this).prev('.title').last().show();
                } else {
                    $(this).hide();
                }
            });
        });

        //Load More List Method implemented on Program Page
        $(".is_card").slice(0, 6).show();
        $("#btnLoadList").on("click", function(e) {
            e.preventDefault();
            $(".is_card:hidden").slice(0, 6).slideDown();
            if ($(".is_card:hidden").length == 0) {
                $("#btnLoadList").text("No more Content").addClass("noContent");
            }
        });


        //Tabbed Panel 
        $('.items a').on("click", function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $(".tab-item").removeClass('active');
            $(this).addClass("active");
            $(".section-header").text(id);
            if (id == 'All') {
                $(".panel").each(function() {
                    $(this).show();
                });
            } else {
                $(".panel").each(function() {
                    $(this).hide();
                    if ($(this).attr('data-panel') == id) {
                        $(this).show();
                    }
                });
            }
        });
    });


    $('.footer-col-heading').on('click', function() {
        if ($(window).width() < 767) {
            $(this).toggleClass('showMenu');
            $(this).next().toggleClass('show');
        }
    });

    $(".form-filter").find('li .lblOutlet').click(function() {
        alert("Clicked");
    });

    //TabPanelList
    $('ul.tab-list li').click(function() {
        var tab_id = $(this).attr('data-tab');

        $('ul.tab-list li').removeClass('active');
        $('.tab-panels').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });
}(jQuery));