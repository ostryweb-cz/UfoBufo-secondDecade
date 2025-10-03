import $ from "jquery";
import iziModal from "../vendor/iziModal";
import videojs from 'video.js';


$(() => {

    let player = null;


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
            if ( player ==  null && $( "#video" ).length !== 0 ) {
                player = videojs('video');
            }
        },
        onClosing: function () {
            $("body").removeClass("bodyfixedmodal");
            if( player != null){
                player.pause();
            }
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




    $("#modal-video").iziModal(modalVideoSettings);
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


