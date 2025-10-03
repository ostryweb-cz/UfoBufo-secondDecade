import $ from "jquery";
import "gsap";


export function fractal() {

    let $layer_1 = $('#lens1'),
        $layer_2 = $('#lens2'),
        $x_axis  = $('#x-axis'),
        $y_axis  = $('#y-axis'),
        $container = $('.topparalax'),
        container_w = $container.width(),
        container_h = $container.height();

    $(window).on('mousemove.parallax', function(event) {
        let pos_x = event.pageX,
            pos_y = event.pageY,
            left  = 0,
            top   = 0;

        left = container_w / 2 - pos_x;
        top  = container_h / 2 - pos_y;


        if ($(window).width() > 1100) {
            TweenMax.to(
                $layer_1,
                3,
                {
                    css: {
                        transform: 'translateY(' + top / 100 + 'px) rotate(' + left / 200 + 'deg)'
                    },
                    ease:Expo.easeOut,
                    overwrite: 'all'
                });
            TweenMax.to(
                $layer_2,
                2,
                {
                    css: {
                        transform: 'translateX(' + left / 24 + 'px) translateY(' + top / 12 + 'px) rotate(' + top / 400 + 'deg)'
                    },
                    ease:Expo.easeOut,
                    overwrite: 'all'
                });

        }
    });

}
