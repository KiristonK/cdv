$(document).ready(function () {
    let textarea = document.querySelector('textarea');
    if (textarea != null){ //Auto resize for textarea elements, if any exists
        textarea.addEventListener('keydown', autosize);
    }

    window.addEventListener("resize", () => {
        redrawMenu(year);
    });
    $('#add').on("click", function () {
        document.getElementById('eventDataInput')
            .setAttribute("action", "./scripts/database_reqs.php?add=true"); //Set route to php file
        let date = $('#modalEvents').find('.modal-title').attr('data-date');
        //Reset fields
        document.getElementById('evDesc').value = "";
        document.getElementById('evName').value = "";
        $('#modalTitle').text("Add Event");
        $('#evDate').val(date);
    });

    $("#edit").on("click", function () {
        let id = $('.custom-control-input:checkbox:checked'); //Get all checked checkboxes on page
        if (id.length === 1) {
            // data-toggle="modal"
            // data-target="#modalEvControl"
            $('#modalEvControl').modal();
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
                    $("#evName").val(json['name']);
                    $("#evDesc").val(json['description']);
                    $("#evDate").val(json['date']);
                    $("#evTS").val(json['time_stop']);
                    $("#evTE").val(json['time_start']);
                    $("#evLink").val(json['link']);
                    $("#evPlace").val(json['place']);
                    $("#event_id").val(json['event_id']);
                }
            });
        } else if (id.length > 1) {
            Alerts.danger("You can not edit multiple events. Choose only one.", "","Error");
        }
        else {
            Alerts.danger("No events are selected.", "", "Error");
        }
    });

    $("#formSubmit").on("click", function () {
        //Get all possible values
        let name = $("#evName").val();
        let description = $("#evDesc").val();
        let date = $("#evDate").val();
        let time_start = $("#evTS").val();
        let time_end = $("#evTE").val();
        let link = $("#evLink").val();
        let place = $("#evPlace").val();
        let id = $("#event_id").val();
        $.ajax({ //HTTP request to specified route
            type: 'POST',
            url: document.getElementById('eventDataInput').getAttribute('action'),
            data: {
                id: id, name: name, date: date, description: description,
                time_start: time_start, time_end: time_end, link: link, place: place
            },//Send all possible values
            success: function (data) {
                if (data !== ""){
                    Alerts.danger("Something went wrong. Server response:", data, "Error!");
                } else {
                    //Refresh modal body
                    let modal = $('#modalEvents');
                    resetModal(modal.attr('data-day'), modal.attr('data-month'), modal.attr('data-mNum'));
                    Alerts.success("","Success!");
                }
            }
        });
    })

    $('#deleteEv').on('click', function () {
        let ids = $('.custom-control-input:checkbox:checked'); //Get all checked checkboxes on page
        if (ids.length > 1) Alerts.warning("Multiple event deleting", "Warning!");
        for (let id of ids) { //HTTP request for each of selected elements from ids array
            $.ajax({
                type: 'POST',
                url: "scripts/database_reqs.php",
                data: {id: id.getAttribute('data-id'), delete: true}, //Send id and specify action
                success: function (data) {
                    if (data !== ""){
                        Alerts.danger(data);
                    }else {
                        //Refresh modal body
                        let modal = $('#modalEvents');
                        resetModal(modal.attr('data-day'), modal.attr('data-month'), modal.attr('data-mNum'));
                    }
                }
            });
        }
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
        modal.find('.modal-title').attr('data-date',year+'-0'+(parseInt(month.id.replace("nav",""))+1)+'-'+day);
        modal.attr('data-day', day);
        modal.attr('data-month', month.innerHTML);
        modal.attr('data-mNum', month.id.replace("nav", ""));
    });

    $('#changeEvColor').on('change', function () { //Change event color
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
