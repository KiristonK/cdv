$(document).ready(function () {
    let textarea = document.querySelector('textarea');
    textarea.addEventListener('keydown', autosize); //Auto resize for textarea elements

    let year = new Date().getFullYear();
    redrawMenu(year, 0);    generateCalendar();
    window.addEventListener("resize", () => {redrawMenu(year)});
    $('#add').on("click", function () {
        document.getElementById('eventDataInput')
            .setAttribute("action", "./scripts/database_reqs.php?add=true"); //Set route to php file
        //Reset fields
        let text = document.getElementById('evDesc');
        let name = document.getElementById('evName');
        $('#modalTitle').text("Add Event");
        $('#evDate').val();
        text.value = "";        text.placeholder = "Enter event information or some notes, that will help you determine this event.";
        name.value = "";        name.placeholder = "Enter event name";
    });

    $("#edit").on("click", function () {
        let id = $(this).children(':selected'); //Get all checked checkboxes in modal body
        if (id.length > 1) alert("You can not edit multiple events. Choose only one.");
        else if (id.length !== 0) {
            document.getElementById('eventDataInput')
                .setAttribute("action", "./scripts/database_reqs.php?edit=true"); //Set route to php file
            id = id[0].getAttribute('data-id'); //Get id from checked checkbox
            $('#modalTitle').text("Edit Event");
            $.ajax({ //HTTP request to php file
                type: 'POST',
                url: "scripts/database_reqs.php",
                data: {id: id, get: true},
                success: function (data) { //Data is returned in JSON format
                    let json = JSON.parse(data);
                    //Set data from respond to fields
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
        //Get all possible values
        let name = $("#evName").val();      let description = $("#evDesc").val();
        let date = $("#evDate").val();      let time_start = $("#evTS").val();
        let time_end = $("#evTE").val();    let link = $("#evLink").val();
        let place = $("#evPlace").val();    let id = $("#event_id").val();
        $.ajax({ //HTTP request to specified route
            type: 'POST',
            url: document.getElementById('eventDataInput').getAttribute('action'),
            data: {id: id, name: name, date: date, description: description,
                time_start: time_start, time_end: time_end, link: link, place: place} //Send all possible values
        });
        let modal = $('#modalEvents');
        resetModal(modal.attr('data-day'), modal.attr('data-month'), modal.attr('data-mNum'));
    })

    $('#deleteEv').on('click', function () {
        let ids = $(this).children(':selected'); //Get all checked checkboxes in modal body
        if (ids.length > 1) alert("Warning. Multiple event deleting.");
        for (let id of ids) { //HTTP request for each of selected elements from ids array
            $.ajax({
                type: 'POST',
                url: "scripts/database_reqs.php",
                data: {id: id.getAttribute('data-id'), delete: true} //Send id and specify action
            });
        }
        let modal = $('#modalEvents');
        resetModal(modal.attr('data-day'), modal.attr('data-month'), modal.attr('data-mNum'));
    });

    $("#year").on("click", function () { //Reset calendar to default values (current time)
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

    $("#prevYear").on('click', function () { //Year decrease
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g); //Get month number from active month id using Regex
        year = year - 1;
        $("#kalDays").fadeOut('fast', function () { //Animation for calendar redraw
            generateCalendar(0, month, year);
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(year);
        $('#year').text(year);
    });
    $("#nextYear").on('click', function (e) { //Year increase
        let month = $('.months').find('.active')[0].id.match(/([^nav])/g); //Get month number from active month id using Regex
        year = year + 1;
        $("#kalDays").fadeOut('fast', function () { //Animation for calendar redraw
            generateCalendar(0, month, year);
            $("#kalDays").fadeIn('fast');
        });
        redrawMenu(year);
        $('#year').text(year);
    })
    $(".months").on('click', function (event) { //Month change by direct click
        event.stopPropagation();
        event.stopImmediatePropagation();
        clrActive();
        let id = this.id;
        document.getElementById(id + "nav").classList.add('active'); //Set selected month as active
        $("#kalDays").fadeOut('fast', function () {
            generateCalendar(0, id, year);
            $("#kalDays").fadeIn('fast');
        });
    });
    $(".fa-angle-double-left").on('click', function () { //Month decrease by controls
        let id = parseInt(clrActive(true).replace("nav", "")) - 1; //Get month number from id
        if (id < 0) id = 11; //Infinite scroll implementation
        document.getElementById(id + "nav").classList.add('active'); //Set selected month as active
        redrawMenu(year, id);
        $("#kalDays").fadeOut('fast', function () { //Animation for calendar redraw
            generateCalendar(0, id, year);
            $("#kalDays").fadeIn('fast');
        });
    });
    $(".fa-angle-double-right").on('click', function () { //Month increase by controls
        let id = parseInt(clrActive(true).replace("nav", "")) + 1; //Get month number from id
        if (id > 11) id = 0;
        document.getElementById(id + "nav").classList.add('active'); //Set selected month as active
        redrawMenu(year, id);
        $("#kalDays").fadeOut('fast', function () { //Animation for calendar redraw
            generateCalendar(0, id, year);
            $("#kalDays").fadeIn('fast');
        });
    });

    $('#modalEvents').on('show.bs.modal', function (event) { //Prepare modal with events
        let day = $(event.relatedTarget)[0].lastChild.innerHTML;
        let month = $('#months').find('.active')[0];
        resetModal(day, month.innerHTML, month.id.replace("nav", ""));
        let modal = $('#modalEvents');
        //Generate title for modal
        modal.find('.modal-title')
            .text("All events on " + ordinal_suffix_of(parseInt(day)) + ", " + month.innerHTML + " " + year);
        modal.attr('data-day', day); modal.attr('data-month', month.innerHTML); modal.attr('data-mNum', month.id.replace("nav", ""));
    });

    $('#changeEvColor').on('change', function () { //Change event color
        /* TODO
        *  Must be stored in db
        *  Implement changing colors with sql in php file
        * */
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
