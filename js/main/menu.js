jQuery(document).ready(($) => {

    $('.menu-toggle').on('click', () => {
        let isMenuToggled = $('#site-navigation-mobile').hasClass('toggled');

        if (!isMenuToggled) {
            $('#site-navigation-mobile ').addClass('toggled');
            $('.menu-toggle').addClass('is-active');
            $('#primary-menu-mobile').attr('aria-expanded', 'true');
            $('html').css({
                'overflow-y': 'hidden'
            });
        } else {
            $('#site-navigation-mobile ').removeClass('toggled');
            $('.menu-toggle').removeClass('is-active');
            $('#primary-menu-mobile').attr('aria-expanded', 'false');
            $('html').css({
                'overflow-y': 'auto'
            });
        }
    });

});