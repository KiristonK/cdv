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

function ordinal_suffix_of(i) {
    let j = i % 10,
        k = i % 100;
    if (j === 1 && k !== 11) {
        return i + "st";
    }
    if (j === 2 && k !== 12) {
        return i + "nd";
    }
    if (j === 3 && k !== 13) {
        return i + "rd";
    }
    return i + "th";
}

function changeLabels(els, style) {
    for (let elem of els) {
        let el = $('label[for="' + elem.id + '"]')[0];
        const prefix = "btn-";
        const classes = el.className.split(" ").filter(c => !c.startsWith(prefix));
        if (parseInt(style) !== 0) {
            el.className = classes.join(" btn-" + style + " ").trim();
        } else {
            el.className = classes.join(" btn-secondary ").trim();
        }
        console.log(el);
    }
}