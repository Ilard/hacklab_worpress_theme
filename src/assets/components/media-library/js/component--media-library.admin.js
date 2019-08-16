/*jshint esversion: 6 */
(function($){
    $(document).ready(function(){
        $('.addmediabutton').click(function(e){
            var $el = $(this).parent();
            e.preventDefault();
            var uploader = wp.media({
                title : 'Envoyer un fichier',
                button : {
                    text : 'Choisir un fichier'
                },
                multiple : false
            })
            .on('select',function(){
                var selection = uploader.state().get('selection');
                var attachment = selection.first().toJSON();
                $('input',$el).val(attachment.url);
                $('img',$el).attr('src',attachment.url);
            })
            .open();
        })
    })
})(jQuery);
