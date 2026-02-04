import $ from "jquery";
// GSAP loaded as global script


export function fractal() {

    let $container = $('.topparalax'),
        $sceneLayers = $('.topparalax .scene');
    
    // Only initialize if the parallax elements exist (homepage)
    if ($container.length === 0 || $sceneLayers.length === 0) {
        return;
    }
    
    let container_w = $container.width(),
        container_h = $container.height();

    // Mouse movement parallax (desktop)
    $(window).on('mousemove.parallax', function(event) {
        let pos_x = event.pageX,
            pos_y = event.pageY,
            left  = 0,
            top   = 0;

        left = container_w / 2 - pos_x;
        top  = container_h / 2 - pos_y;

        if ($(window).width() > 1100) {
            // Apply mouse movement to all scene layers
            $sceneLayers.each(function() {
                let $layer = $(this),
                    modifier = parseFloat($layer.data('modifier')) || 1,
                    x_movement = left / (5 * modifier),
                    y_movement = top / (5 * modifier);

                // Preserve the translateX(-50%) centering in the transform
                window.gsap.to(
                    $layer,
                    {
                        duration: 0.6,
                        transform: 'translateY(' + y_movement + 'px) translateX(calc(-50% + ' + x_movement + 'px))',
                        ease: 'power2.out',
                        overwrite: 'auto'
                    });
            });
        }
    });


}
