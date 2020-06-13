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
    $('#add').on("click", function (caller) {
        let form = document.getElementById('eventDataInput');
        form.setAttribute("action", "./scripts/database_reqs.php?add=true");
        let text = document.getElementById('evDesc');
        let name = document.getElementById('evName');
        $('#modalTitle').text("Add Event");
        console.log(caller);
        $('#evDate').val();
        text.value = "";
        name.value = "";
        text.placeholder = "Enter event information or some notes, that will help you determine this event.";
        name.placeholder = "Enter event name";
    });

    $("#edit").on("click", function () {
        let id = $('.custom-control-input:checkbox:checked')
        if (id.length > 1) alert("You can not edit multiple events. Choose only one.");
        else if (id.length != 0) {
            let form = document.getElementById('eventDataInput');
            id = id[0].getAttribute('data-id');
            form.setAttribute("action", "./scripts/database_reqs.php?edit=true");
            $('#modalTitle').text("Edit Event");
            $.ajax({
                type: 'POST',
                url: "scripts/database_reqs.php",
                data: {id: id, get: true},
                success: function (data) {
                    let json = JSON.parse(data);
                    $("#evName").val(json['name']);      $("#evDesc").val(json['description']);
                    $("#evDate").val(json['date']);      $("#evTS").val(json['time_stop']);
                    $("#evTE").val(json['time_start']);    $("#evLink").val(json['link']);
                    $("#evPlace").val(json['place']);  $("#event_id").val(json['event_id']);
                }
            });
        } else {
            let form = document.getElementById('eventDataInput');
            form.innerHTML = "<h1 class='font-weight-light'>No events selected.</h1>"
        }
    });

    $("#formSubmit").on("click", function () {
        let name = $("#evName").val();      let description = $("#evDesc").val();
        let date = $("#evDate").val();      let time_start = $("#evTS").val();
        let time_end = $("#evTE").val();    let link = $("#evLink").val();
        let place = $("#evPlace").val();    let id = $("#event_id").val();
        alert(id);
        $.ajax({
            type: 'POST',
            url: document.getElementById('eventDataInput').getAttribute('action'),
            data: {id: id, name: name, date: date, description: description,
                time_start: time_start, time_end: time_end, link: link, place: place}
        });
    })

    $('#deleteEv').on('click', function () {
        let id = $('.custom-control-input:checkbox:checked');
        id = id[0].getAttribute('data-id');
        alert(id);

        let form = document.getElementById('eventDataInput');
        form.setAttribute("action", "./scripts/database_reqs.php?delete=true");
        
        $.ajax({
            type: 'POST',
            url: "scripts/database_reqs.php",
            data: {id: id,delete: true}
        });
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
