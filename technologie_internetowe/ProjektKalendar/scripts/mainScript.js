$(function() {
    $('[data-toggle="popover"]').popover()
});

$(document).ready(function () {
    let year = new Date().getFullYear();
    redrawMenu(year, 0);
    generateCalendar();
    window.addEventListener("resize", func => {
        redrawMenu(year)
    });
    $("#year").on("click", function (e) {
        let date = new Date();
        clrActive();
        document.getElementById((date.getMonth() + 1) + "nav").classList.add('active');
        generateCalendar(0, date.getMonth(), date.getFullYear());
        redrawMenu(date.getFullYear());
        $('#year').text(date.getFullYear());
    });

    $("#prevYear").on('click', function (e) {
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
        year = year - 1;
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, month - 1, year);
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(year);
        $('#year').text(year);
    });
    $("#nextYear").on('click', function (e) {
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
        year = year + 1;
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, month - 1, year);
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(year);
        $('#year').text(year);
    })
    $(".months").on('click', function (event) {
        event.stopPropagation();
        event.stopImmediatePropagation();
        clrActive();
        let id = this.id;
        document.getElementById(id + "nav").classList.add('active');
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, id - 1, year);
            $("#kalDays").fadeIn('fast');
        });
    });
    $(".fa-angle-double-left").on('click', function () {
        let id = parseInt(clrActive(true).replace("nav", "")) - 1;
        if (id < 0) id = 11;
        document.getElementById(id + "nav").classList.add('active');
        redrawMenu(year, id);
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, id, year);
            $("#kalDays").fadeIn('fast');
        });
    });
    $(".fa-angle-double-right").on('click', function () {
        let id = parseInt(clrActive(true).replace("nav", "")) + 1;
        if (id > 11) id = 0;
        document.getElementById(id + "nav").classList.add('active');
        redrawMenu(year, id);
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, id, year);
            $("#kalDays").fadeIn('fast');
        });
    });
    let els = document.getElementsByClassName("day");
    [].forEach.call(els, function (el) {
        el.addEventListener("click", function () {

        })
    });
    $('#modalEvents').on('show.bs.modal', function (event) {
        let caller = $(event.relatedTarget)[0];
        let month = $('#months').find('.active')[0].innerHTML;
        let modal = $('#modalEvents');

        modal.find('.modal-title').text("All events on " + caller.lastChild.innerHTML + ", " + month + ", " + year);
        //generateModalEvents(modal, caller);
    });

    $(".day .out-of-days").on("click", function (event) {
        event.stopPropagation();
        event.stopImmediatePropagation();
        console.log(event);
        if (parseInt($(this)[0].innerHTML) > 20) {
            $(".fa-angle-double-left").trigger("click");
        } else {
            $(".fa-angle-double-right").trigger("click");
        }
    });
});
