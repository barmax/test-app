function sendGiftSum() {
    const sum = $(".gift-active .gift__item--sum").text();
    const giftId = $(".gift-active").attr('id');


    $.get(
        'gift/set',
        {
            id: giftId,
            sum: sum
        }
    )
}

$(document).ready(function () {

    $("#gift-btn").on('click', function (e) {
        e.preventDefault();
        $("#gift-info").fadeOut(300);
        $("#gift-box").fadeIn(300);
        $(".gift__btn").fadeIn(350);

        $("#gift-get").on("click", function (e) {
            sendGiftSum();
        });

        $("#gift-cancel").on("click", function (e) {
            e.preventDefault();
            location.href = location.href;
        });


    })

}); // end ready