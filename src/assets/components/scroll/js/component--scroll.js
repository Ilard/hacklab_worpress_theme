jQuery(($) => {

    const body = $('body'),
          classTop = 'scrollToTop',
          classBottom = 'scrollToBottom',
          classScrolled = 'scrolled';

    let scrollPos = 0;

    $(window).on('scroll', () => {

        let currentScrollPos = $(window).scrollTop();

        if (currentScrollPos !== 0) {
            body.addClass(classScrolled);
        }

        if (currentScrollPos > scrollPos) {
            body.addClass(classBottom)
                .removeClass(classTop);
        }

        if (currentScrollPos < scrollPos) {
            body.addClass(classTop)
                .removeClass(classBottom);
        }

        if (currentScrollPos === 0) {
            body.removeClass(classScrolled)
                .removeClass(classTop);
        }

        scrollPos = currentScrollPos;
    });
});
