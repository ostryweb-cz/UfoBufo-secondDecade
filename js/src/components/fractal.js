import $ from "jquery";
// GSAP loaded as global script


export function fractal() {

    let $layer_1 = $('#lens1'),
        $layer_2 = $('#lens2'),
        $x_axis  = $('#x-axis'),
        $y_axis  = $('#y-axis'),
        $container = $('.topparalax');
    
    // Only initialize if the parallax elements exist (homepage)
    if ($layer_1.length === 0 || $layer_2.length === 0 || $container.length === 0) {
        return;
    }
    
    let container_w = $container.width(),
        container_h = $container.height();

    $(window).on('mousemove.parallax', function(event) {
        let pos_x = event.pageX,
            pos_y = event.pageY,
            left  = 0,
            top   = 0;

        left = container_w / 2 - pos_x;
        top  = container_h / 2 - pos_y;


        if ($(window).width() > 1100) {
            window.gsap.to(
                $layer_1,
                {
                    duration: 3,
                    transform: 'translateY(' + top / 100 + 'px) rotate(' + left / 200 + 'deg)',
                    ease: 'expo.out',
                    overwrite: 'auto'
                });
            window.gsap.to(
                $layer_2,
                {
                    duration: 2,
                    transform: 'translateX(' + left / 24 + 'px) translateY(' + top / 12 + 'px) rotate(' + top / 400 + 'deg)',
                    ease: 'expo.out',
                    overwrite: 'auto'
                });

        }
    });

}
