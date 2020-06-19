class Alerts {
    constructor(props) {}

    static danger(message, data, title){
        $('#alert_title').text(title)
        document.getElementById('info_text').innerText = message;
        document.getElementById('alert_body').innerHTML += data;
        $('#alert_body').alterClass('alert-*', 'alert-danger');
        $("#alert_div").fadeIn(0, function () {
            setTimeout(function() {$('#alert_div').fadeOut('slow', function () {
                document.getElementById('alert_body').innerHTML = "<strong id=\"alert_title\"></strong><p id=\"info_text\"></p>";
            });}, 3000);
        });
    }
    static success(message, title){
        $('#alert_title').text(title)
        document.getElementById('info_text').innerText = message;
        $('#alert_body').alterClass('alert-*', 'alert-success');
        $("#alert_div").fadeIn(0, function () {
            setTimeout(function() {$('#alert_div').fadeOut('slow');}, 3000);
        });
    }
    static warning(message, title){
        $('#alert_title').text(title)
        document.getElementById('info_text').innerText = message;
        $('#alert_body').alterClass('alert-*', 'alert-warning');
        $("#alert_div").fadeIn(0, function () {
            setTimeout(function() {$('#alert_div').fadeOut('slow');}, 3000);
        });
    }
}