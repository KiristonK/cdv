String.prototype.splice = function(idx, rem, str) {
    return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
};

function autosize(key){
    if (key.key == "Enter" || key.key == "Backspace") {
        let el = this;
        setTimeout(function () {
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 0);
    }
}

function isDatesSame(date1, date2) {
    return date1.getFullYear() === date2.getFullYear() &&
    date1.getMonth() === date2.getMonth() &&
    date1.getDate() === date2.getDate();
}

function generateCalendar(day, month, year) {
    const date = new Date();
    if (day == null || day === 0) day = 1;
    if (month == null) {month = date.getMonth(); }else document.getElementById('kalDays').innerHTML = "";
    if (year == null || year === 0) year = date.getFullYear();
    let oMonth = month;
    let extraDays = "<div class=\"card-body m-2 p-0 rounded day text-center\" ><a role='button' class=\"display-4 out-of-days\" style='z-index: -1' >";
    let regDay = "<div class=\"card-body m-2 p-0 rounded day text-center\" data-toggle=\"modal\" data-target=\"#modalEvents\"><a role='button' class=\"display-4\" style='z-index: -1'>";
    for (let y = 0; y < 6; y++) {
        let row = document.createElement("div");
        row.classList.add('row');
        row.id = 'week' + y;
        let allDays = new Date(Date.UTC(year, month + 1, 0)).getDate();
        for (let i = 0; i < 7; i++) {
            let dayOfWeek = new Date(Date.UTC(year, month, day, 0, 0)).getDay();
            if (dayOfWeek === i && day <= allDays) {
               if (oMonth === month)
                    if (isDatesSame(date, new Date(year,month, day))) row.innerHTML += regDay.splice(53,  0, " border border-primary shadow shadow-sm") + day + "</a></div>\n";
                        else row.innerHTML += regDay + day + "</a></div>\n";
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
    if (month === 0 || month === null)
        month = ($('#months').find('.active')[0].id.match(/([^nav])/g));
    month = parseInt(month);
    let wWidth = $(window).width();
    $("#months").find('.nav-item').each(function (index) {
        if (wWidth < 1500) {
            if (index < month - 3 || index > month + 3) {
                document.getElementById(index).classList.add('d-none');
            } else document.getElementById(index).classList.remove('d-none');
        } else document.getElementById(index).classList.remove('d-none');
    });
}

function clrActive(arrow) {
    let act = $('#months').find('.active');
    let id = 0;
    if (arrow) id = act[0].id;
    act[0].classList.remove('active');
    return id;
}

function ordinal_suffix_of(i) {
    let j = i % 10, k = i % 100;
    if (j === 1 && k !== 11) return i + "st";
    if (j === 2 && k !== 12) return i + "nd";
    if (j === 3 && k !== 13) return i + "rd";
    return i + "th";
}

function changeLabels(els, style) {
    for (let elem of els) {
        let el = $('label[for="' + elem.id + '"]')[0];
        const prefix = "btn-";
        const classes = el.className.split(" ").filter(c => !c.startsWith(prefix));
        if (parseInt(style) !== 0) {
            el.className = classes.join(" btn-" + style + " ").trim();
        } else el.className = classes.join(" btn-secondary ").trim();
    }
}

function convertPlace(address) {
    for (let ch in address) if (ch == ' ') ch = '+';
    return address;
}

function resetModal(day, month, monthNum) {
    $("#modalEventsTable").html("");
    $("#changeEvColor").val(0);     $("#changeEvColor").trigger("change");
    $.ajax({
        url: "scripts/modalEvents.php",
        type: 'POST',
        data: {day: day, month: month, monthNum: monthNum, year: $('#year').text()},
        success: function (data) {
            $("#modalEventsTable").append(data);
            let size = document.getElementById('modalEventsTable').childNodes.length;
            for (let i = 0; i < size; i++) {
                let elem = $('#labelCheck' + i);
                let content = '<div class="col">';
                if (elem.attr("data-link") !== "")content +='<div class="row">Link:<a href="'+elem.attr("data-link")+'" class="font-weight-light ml-2">'+elem.attr("data-link")+'</a></div>';
                if (elem.attr("data-place") !== "")content +='<div class="row border-bottom" style="border-color: #d3d3d3;"><p>Place: <a href="https://www.google.com/maps/search/?api=1&query='+convertPlace(elem.attr("data-place"))+'">'+elem.attr("data-place")+'</a></p></div>';
                if (elem.attr("data-stime") !== "" && elem.attr("data-etime") !== "") content += '<div class="row border-bottom" style="border-color: #d3d3d3;"><p>From: '+elem.attr("data-stime")+'    To: '+elem.attr("data-etime")+'</p></div>'
                else content += '<div class="row border-bottom" style="border-color: #d3d3d3;"><p>All day</p></div>';
                content += '<div class="row""><p>'+elem.attr("data-info")+'</p></div></div>'
                elem.popover({
                    title: elem.attr("data-name"),
                    html: true,
                    content: content,
                    placement: 'top',
                    trigger: 'manual'
                }).on('mouseenter', function () {
                    let _this = this;
                    $(this).popover('show');
                    $('.popover').on('mouseleave', function () {
                        $(_this).popover('hide');
                    });
                }).on('mouseleave', function () {
                    let _this = this;
                    setTimeout(function () {
                        if (!$('.popover:hover').length) {
                            $(_this).popover('hide');
                        }
                    }, 300);
                });
                elem.attr("data-info", "");elem.attr("data-name", "");elem.attr("data-place", "");
                elem.attr("data-stime", "");elem.attr("data-etime", "");
            }
        }
    });
}