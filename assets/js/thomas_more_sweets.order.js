(function ($) {
    $(document).ready(function () {
        $('.sweets a').on('click', function(e) {
            e.preventDefault();
            var sweet = $(this).data( "sweet" );
            $.ajax({
                type: "POST",
                data: { 
                    sweet: sweet
                },
                url: "/ajax/thomas-more-sweets/order",
                success: function(resp) {
                    $('.'+sweet+'-order-list').after(`<p style="font-weight: bold">${resp}</p>`);
                    $('.'+sweet+'-counter').text('0');
                    $('.'+sweet+'-order-list').remove();
                    $('.'+sweet+'-reset-btn').remove();
                },
                error: function() {
                    console.log('error');
                }
            });
        });
    });
}(jQuery));
