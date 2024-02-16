// Загрузка документа
// Событие которое срабатывает после загрузки документа
$(document).ready(function () {
    BodySpaceFixed();
    $('button[type="submit"]').on("click", function () {
        return confirm("Вы уверены?");
    });
    
    $('input[type="reset"]').on("click", function () {
        return confirm("Вы уверены, что хотите сбросить форму?");
    });
});

// Начало загрузки страницы
$(window).on("beforeunload", function () {
    $("#preloader").fadeIn(150);
});

// Конец загрузки страницы
$(window).on("load", function () {
    $("#preloader").fadeOut(500);
});

// $(document).ready(function() {
//   // Показать прелоадер при загрузке страницы
//   $('#preloader').show();

//   // Скрыть прелоадер, когда документ полностью прогружен
//   $(window).on('load', function() {
//     $('#preloader').fadeOut(150);
//   });
// });

$(function () {
    $("#start_date").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selectedDate) {
            calculateRentDays();
        },
    });

    $("#end_date").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selectedDate) {
            calculateRentDays();
        },
    });

    function calculateRentDays() {
        var startDate = $("#start_date").datepicker("getDate");
        var endDate = $("#end_date").datepicker("getDate");

        if (startDate && endDate) {
            var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            var rentDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            var cartSumm = $("#price_day").text() * rentDays;

            $("#rent_days").text(rentDays);
            $("#cart_summ").text(cartSumm);
        } else {
            $("#rent_days").text("0");
            $("#cart_summ").text("0");
        }
    }
});

// Отступы контента
// Присвоение отступов равное закрепленным элементам сверху и снизу
function BodySpaceFixed() {
    // const top = $(".fixed-top");
    // const bottom = $(".fixed-bottom");
    // const body = $("body");
    // const main = $("main");
    // const footer = $("footer");

    // body.css("padding-top", top.height() + "px");
    // body.css("padding-bottom", bottom.height() + "px");
    // main.css("min-height", "100vh");
    // main.css("min-height", main.height() - footer.height() - top.height() + "px");

    const top = $(".fixed-top");
    const bottom = $(".fixed-bottom");
    const body = $("body");

    if (top.length > 0) {
        const topOffset = top.height();
        body.css("padding-top", topOffset + "px");
    }

    if (bottom.length > 0) {
        const bottomOffset = bottom.height();
        body.css("padding-bottom", bottomOffset + "px");
    }

    $("a[href^='#']").on("click", function (e) {
        e.preventDefault();

        const targetId = $(this).attr("href").substring(1);
        const targetElement = $("#" + targetId);

        if (targetElement.length > 0) {
            const offset = top.height();
            window.scrollTo({
                top: targetElement.offset().top - offset,
                behavior: "smooth",
            });
        }
    });
}

var scrollOld = 0;
$(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    var windowHeight = $(this).height();
    var fixedTop = $(".fixed-top");
    var fixedBottom = $(".fixed-bottom");
    var escort = $(".escort");

    if (scrollTop > windowHeight) {
        escort.css({
            opacity: 1,
        });
    } else {
        escort.css({
            opacity: 0,
        });
    }

    if (
        scrollTop > scrollOld &&
        scrollTop > windowHeight &&
        scrollTop + windowHeight < $(document).height() - windowHeight
    ) {
        fixedTopPosition = fixedTop.height() * -1;
        fixedBottomPosition = fixedBottom.height();
    } else {
        fixedTopPosition = 0;
        fixedBottomPosition = 0;
    }

    fixedTop.css({
        transform: "translateY(" + fixedTopPosition + "px)",
    });
    fixedBottom.css({
        transform: "translateY(" + fixedBottomPosition + "px)",
    });

    scrollOld = scrollTop;
});
