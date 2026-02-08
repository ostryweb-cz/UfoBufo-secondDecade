import $ from "jquery";
// iziModal and Swiper loaded as global scripts


export function mainSlider() {
    //initialize swiper when document ready

    let slides = $('.galleryItem').length  - 1;
    $('.galleryItem__length').html("(" + slides + ")");

    let swiper;

    function ensureSlideImageLoaded(swiperInstance, slideIndex) {
        if (!swiperInstance || !swiperInstance.slides) return;
        if (slideIndex < 0 || slideIndex >= swiperInstance.slides.length) return;

        const slideEl = swiperInstance.slides[slideIndex];
        if (!slideEl) return;

        const imgEl = slideEl.querySelector('img[data-src]');
        if (!imgEl) return;

        const src = imgEl.getAttribute('data-src');
        if (!src) return;

        imgEl.setAttribute('src', src);
        imgEl.removeAttribute('data-src');
    }

    function ensureActiveAndNeighborImagesLoaded(swiperInstance) {
        if (!swiperInstance) return;
        const idx = swiperInstance.activeIndex;
        ensureSlideImageLoaded(swiperInstance, idx);
        ensureSlideImageLoaded(swiperInstance, idx - 1);
        ensureSlideImageLoaded(swiperInstance, idx + 1);
    }

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

            // Use global Swiper (swiper-bundle includes all modules)
            swiper = new window.Swiper('.swiper-container', {
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
                        ensureActiveAndNeighborImagesLoaded(this);
                    },
                    slideChange: function () {
                        ensureActiveAndNeighborImagesLoaded(this);
                    }
                },
            });

            swiper.update();

            // Add keyboard navigation
            $(document).on('keydown.gallery', function(e) {
                if (swiper) {
                    if (e.key === 'ArrowRight') {
                        swiper.slideNext();
                    } else if (e.key === 'ArrowLeft') {
                        swiper.slidePrev();
                    }
                }
            });
        },
        onClosing: function () {
            $("body").removeClass("bodyfixedmodal");
            $(".swiper-container").css("visibility", "hidden");

            // Remove keyboard navigation listener
            $(document).off('keydown.gallery');

            if (swiper) {
                swiper.destroy(true, true);
                swiper = undefined;
            }
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
