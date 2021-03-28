const delay = 2000;
var alertList = document.querySelectorAll('.alert');
alertList.forEach(function (alert) {
    new bootstrap.Alert(alert);
});

function closeAlert() {
    var alertNode = document.querySelector('.alert');
    var alert = bootstrap.Alert.getInstance(alertNode);
    alert.close();
}
setTimeout(closeAlert, delay);
