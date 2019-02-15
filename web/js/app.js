
function randomInteger(min, max) {
    let rand = min + Math.random() * (max + 1 - min);
    rand = Math.floor(rand);
    return rand;
}

function getProgress() {
    const result = [];

    while (result.length <= 10) {
        let integer = randomInteger(1, 3);

        if (result.length === 0) {
            result.push(integer);
        } else {
            if (result[result.length - 1] !== integer) {
                result.push(integer);
            }
        }
    }

    return result;
}


function run(progress, speed) {
    let i = 0;
    let timerId = setInterval(function() {
        $('#' + progress[i]).removeClass('gift-active')
        i++;
        $('#' + progress[i]).addClass('gift-active');
        console.log(progress[i]);
        if (i == 10)  {
            const el =  $('.gift__btn');
            el.fadeIn(200);
            $('.gift__item--sum').fadeIn(200);
            if (progress[i] !== 3) {
                $('#btn-cancel').hide();
            }
            $('.gift__btn').on('click', function (e) {
                e.preventDefault();
                sendGiftSum();
            })
            clearInterval(timerId);

        }
    }, speed);
}

function setSumGift(giftId) {
     const sumPromice = Promise.resolve($.get(
        'gift/get',
        {
            id : giftId
        },
        onAjaxSuccess,
    ));

    sumPromice.then(function(value) {
        setSum(giftId, value);
    });
}

function onAjaxSuccess(data) {
    return data;
}

function setSum(giftId, sum) {
    $("#" + giftId + " .gift__item--sum").text(sum);
}

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
$(document).ready(function() {

$("#gift-btn").on('click', function (e) {
    e.preventDefault();
    $("#gift-info").fadeOut(300);
    $("#gift-box").fadeIn(300);
    const progressList = getProgress();
    const progressSpeed = 500;
    const giftId = progressList[progressList.length - 1];

    setSumGift(giftId);
    setTimeout(function () {
        run(progressList, progressSpeed);
    }, 700);

})

}); // end ready