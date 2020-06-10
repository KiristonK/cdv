$(document).ready(function () {
    let textarea = document.querySelector('textarea');

    textarea.addEventListener('keydown', autosize);

    function autosize(key){
        if (key.key == "Enter" || key.key == "Backspace") {
            let el = this;
            setTimeout(function () {
                el.style.cssText = 'height:auto; padding:0';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
            }, 0);
        }
    }
    let year = new Date().getFullYear();
    redrawMenu(year, 0);
    generateCalendar();
    window.addEventListener("resize", func => {
        redrawMenu(year)
    });
    $("#add").on("click", function (caller) {
        let form = document.getElementById('eventDataInput');
        let text = form.getElementsByTagName('textarea')[0];
        let name = form.getElementsByTagName('input')[0];
        $('#modalTitle').text("Add Event");
        console.log(caller);
        $('#evDate').val();
        text.value = "";
        name.value = "";
        text.placeholder = "Enter event information or some notes, that will help you determine this event.";
        name.placeholder = "Enter event name";
    });

    $("#edit").on("click", function () {
        let form = document.getElementById('eventDataInput');
        form.classList.remove('d-none');
        $('#modalTitle').text("Edit Event");
        form.getElementsByTagName('textarea')[0].value = "Event info from db";
        form.getElementsByTagName('input')[0].value = "Event name from db";
    });

    $("#formSubmit").on("click", function () {
        let name = $("#evName").val();
        let description = $("#evDesc").val();
        let date = $("#evDate").val();
        let time_start = $("#evTS").val();
        let time_end = $("#evTE").val();
        $.ajax({
            type: 'POST',
            url: "scripts/database_reqs.php",
            data: {add: true, name: name, date: date, description: description, time_start: time_start, time_end: time_end},
            success: function (data) {
                console.log("Succ\n"+data);
            }
        });
    })

    $('#deleteEv').on('click', function () {
        let id = "";
        /*TODO
        * remove event from db by it's id
        * */
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
