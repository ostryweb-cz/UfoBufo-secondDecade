import $ from "jquery";
import iziModal from "../vendor/iziModal";
import Swiper from 'swiper';


export function mainSlider() {
    //initialize swiper when document ready

    // let imageIndex = 0;


    let slides = $('.galleryItem').length  - 1;
    $('.galleryItem__length').html("(" + slides + ")");


    //console.log(slides - 3);

    let swiper;
    // let swiperThumbs;

    let modalGallerySettings = {
        appendTo: ".body",
        borderBottom: true,
        radius: false,
        closeOnEscape: true,
        closeButton: true,
        overlay: true,
        width: "100%",
        overlayClose: true,
        overlayColor: "rgba(13, 19, 59 , 1)",
        transitionIn: "comingIn",
        transitionOut: "comingOut",
        transitionInOverlay: "fadeIn",
        transitionOutOverlay: "fadeOut",
        onOpened: function () {
            $("body").addClass("bodyfixedmodal");



            swiper = new Swiper('.swiper-container', {
                initialSlide: window.imageIndex - 1,
                slidesPerView: 1,
                centeredSlides: true,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'fraction',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                on: {
                    init: function () {
                        $(".swiper-container").css("visibility", "visible");
                    }
                },
            });

            swiper.update();


        },
        onClosing: function () {
            $("body").removeClass("bodyfixedmodal");
            $(".swiper-container").css("visibility", "hidden");

        }
    };

    $("#modal-gallery").iziModal(modalGallerySettings);


    $("body").on("click", ".galleryItem", function(event) {
        let modalTransitions = {
            transitionIn: "fadeInDown",
            transitionOut: "fadeInUp"
        };

        event.preventDefault();
        window.imageIndex = $(this).data("imageidx");
        $("#modal-gallery").iziModal("open", modalTransitions);



    });

}