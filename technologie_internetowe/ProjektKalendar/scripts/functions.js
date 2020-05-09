function generateCalendar(day, month, year) {
    const date = new Date();
    if (day == null || day === 0) day = 1;
    if (month == null) {
        $("li").each(function (index) {
            if (index === date.getMonth()) month = index;
        });
    } else document.getElementById('kalDays').innerHTML = "";
    if (year == null || year === 0) year = date.getFullYear();
    let oMonth = month;
    let extraDays = "<div class=\"card-body m-2 p-0 rounded day text-center\" ><a role='button' class=\"display-4 out-of-days\" style='z-index: -1' >";
    let regDay = "<div class=\"card-body m-2 p-0 rounded day text-center\" data-toggle=\"modal\" data-target=\"#modalEvents\"><a role='button' class=\"display-4\" style='z-index: -1'>";
    for (let y = 0; y < 6; y++) {
        let row = document.createElement("div");
        row.classList.add('row');
        row.id = 'week' + y;
        for (let i = 0; i < 7; i++) {
            let dayOfWeek = new Date(Date.UTC(year, month, day, 0, 0)).getDay();
            let allDays = new Date(Date.UTC(year, month + 1, 0)).getDate();
            if (dayOfWeek === i && day <= allDays) {
                if (oMonth === month)
                    row.innerHTML += regDay + day + "</a></div>\n";
                else
                    row.innerHTML += extraDays + day + "</a></div>\n";
                day++;
            } else {
                if (day >= allDays) {
                    day = 1;
                    row.innerHTML += extraDays + day + "</h1></div>\n";
                    day++;
                    month++;
                } else {
                    let oDay = new Date(Date.UTC(date.getFullYear(), month, 0)).getDate() - (dayOfWeek) + i + 1;
                    row.innerHTML += extraDays + oDay + "</h1></div>\n";
                }
            }
        }
        document.getElementById('kalDays').appendChild(row);
    }
}

function redrawMenu(year, month) {
    let active = month;
    if (month === 0 || month === null)
        active = ($('#months').find('.active')[0].id.match(/([^nav])/g));
    active = parseInt(active)
    let months = $("#months").find('.nav-item');
    let range = 3, last = active - range, first = active + range;
    if ($(window).width() < 1500) {
        months.each(function (index) {
            if (index < active - range || index > active + range) {
                document.getElementById(index).classList.add('d-none');
            } else {
                document.getElementById(index).classList.remove('d-none');
            }
        });
    } else {
        months.each(function (index) {
            document.getElementById(index).classList.remove('d-none');
        });
    }
}

function clrActive(arrow) {
    let act = $('#months').find('.active');
    let id = 0;
    if (arrow) id = act[0].id;
    act[0].classList.remove('active');
    return id;
}

function generateModalEvents(modal, caller) {
    let block = modal.find('.modalEvents')[0];
    block.innerHTML = "";
    for (let i = 0; i < 12; i++) {
        let event = document.createElement("DIV");
        event.classList.add('d-table-row');
        let cell = document.createElement("DIV");
        cell.classList.add('d-table-cell', 'w-100')
        cell.innerHTML = "<button class=\"btn btn-secondary w-100 m-1\"  data-container=\"body\"\n" +
            " data-toggle=\"popover\"\n" +
            " data-placement=\"top\"\n" +
            " data-trigger=\"hover\"\n" +
            " title=\"Popover xd\"\n" +
            " data-content=\"this is a popover\">Event" + i + "</button>";
        event.appendChild(cell);
        block.appendChild(event);
    }
}