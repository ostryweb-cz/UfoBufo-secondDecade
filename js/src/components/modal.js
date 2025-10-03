import $ from "jquery";
// iziModal loaded as global jQuery plugin


$(() => {

    let modalVideoSettings = {
        appendTo: ".body",
        borderBottom: true,
        radius: false,
        closeOnEscape: true,
        closeButton: true,
        overlay: true,
        overlayClose: true,
        overlayColor: "rgba(14 ,20 ,60 , 0.92)",
        transitionIn: "comingIn",
        transitionOut: "comingOut",
        transitionInOverlay: "fadeIn",
        transitionOutOverlay: "fadeOut",
        onOpening: function () {
            $("body").addClass("bodyfixedmodal");
        },
        onClosing: function () {
            $("body").removeClass("bodyfixedmodal");
        }
    };

    // let modalGallerySettings = {
    //     appendTo: ".body",
    //     borderBottom: true,
    //     radius: false,
    //     closeOnEscape: true,
    //     closeButton: true,
    //     overlay: true,
    //     width: "100%",
    //     overlayClose: true,
    //     overlayColor: "rgba(14 ,20 ,60 , 0.92)",
    //     transitionIn: "comingIn",
    //     transitionOut: "comingOut",
    //     transitionInOverlay: "fadeIn",
    //     transitionOutOverlay: "fadeOut",
    //     onOpening: function () {
    //         //$("body").addClass("bodyfixedmodal");
    //
    //     },
    //     onClosing: function () {
    //         //$("body").removeClass("bodyfixedmodal");
    //
    //     }
    // };




    // Only initialize if the element exists
    if ($("#modal-video").length > 0) {
        $("#modal-video").iziModal(modalVideoSettings);
    }
    // $("#modal-gallery").iziModal(modalGallerySettings);




	$("body").on("click", function(event) {
		let modalTransitions = {
            transitionIn: "fadeInDown",
            transitionOut: "fadeInUp"
        };

        if (event.target.classList.contains("open--modal--video")) {
            event.preventDefault();
            $("#modal-video").iziModal("open", modalTransitions);
        }

        // if (event.target.classList.contains("open--gallery")) {
        //     event.preventDefault();
        //     $("#modal-gallery").iziModal("open", modalTransitions);
        // }

    });
});


