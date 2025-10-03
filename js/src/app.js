import $ from "jquery";
import { mainSlider } from "./components/gallerySwiper";
import { responsiveMenu } from "./components/responsiveMenu";
import { fractal } from "./components/fractal";
import { toggleLineUp } from "./components/toggle-lineup";
import { toggleSearch } from "./components/toggle-search";
import { moveItems } from "./components/move-items";
import { trimItems } from "./components/trim-items";
import { replaceDates } from "./components/replace-dates";
import "./components/modal";



import * as basicScroll from 'basicscroll'



$(() => {
    responsiveMenu();
    fractal();
    toggleLineUp();
    toggleSearch();
    moveItems();
    trimItems();
    replaceDates();
    mainSlider();

    //preloader
    $(window).load(function() {
        $('.loader').fadeOut('slow');
    });

    //paralax
    document.querySelectorAll('.scene').forEach((elem) => {

        const modifier = elem.getAttribute('data-modifier');

        basicScroll.create({
            elem: elem,
            from: 0,
            to: 650,
            direct: true,
            props: {
                '--translateY': {
                    from: '0',
                    to: `${ 10 * modifier }px`
                }
            }
        }).start()
    });









});


