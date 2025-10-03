import $ from "jquery";
import tooltipster from "tooltipster";


export function tooltips() {
    $(document).ready(function() {


        $('.tooltip-container').tooltipster({
            trigger: "click",
            viewportAware: true,
            side: ['top', 'bottom', 'left', 'right'],
            trackOrigin: true,
            contentAsHTML: true,
            interactive: true,
            theme: 'tooltipster-shadow',
            functionInit: function (instance, helper) {
                let content = $(helper.origin).find('.tooltip_content').detach();
                instance.content(content);
            }
        });


    });
}
