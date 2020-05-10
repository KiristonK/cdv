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
        document.getElementById((date.getMonth()) + "nav").classList.add('active');
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, date.getMonth(), date.getFullYear());
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(date.getFullYear());
        $('#year').text(date.getFullYear());
    });

    $("#prevYear").on('click', function (e) {
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
        year = year - 1;
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, month, year);
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(year);
        $('#year').text(year);
    });
    $("#nextYear").on('click', function (e) {
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
        year = year + 1;
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, month, year);
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
            generateCalendar(0, id, year);
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

    $('#modalEvents').on('show.bs.modal', function (event) {
        let caller = $(event.relatedTarget)[0];
        let month = $('#months').find('.active')[0];
        let modal = $('#modalEvents');
        resetModal(caller, month);
        modal.find('.modal-title').text("All events on " + ordinal_suffix_of(parseInt(caller.lastChild.innerHTML)) + ", " + month.innerHTML + " " + year);
    });

    $('#changeEvColor').on('change', function (ev) {
        let initStyle = "w-100 m-2 custom-select ";
        let addStyle = "text-light bg-";
        if (parseInt($(this).children(':selected').val()) !== 0) {
            $(this).attr('class', '').addClass(initStyle + addStyle + $(this).children(':selected').val());
        } else {
            $(this).attr('class', '').addClass(initStyle + "bg-light text-dark");
        }
        changeLabels($('#modalEvents input[type="checkbox"]:checked'), $(this).children(':selected').val());
    });
});
