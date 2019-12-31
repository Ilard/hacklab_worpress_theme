jQuery(function($){

    const   menu = $('.header-menu'),
            toggleButton = $('.header-menu-toggle');

    toggleButton.on('click', () => {
        menu.toggleClass('js-menu-active');
    });

});
