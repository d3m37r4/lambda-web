// Hide notification after a specified time
const delay = 2000;
let alertList = document.querySelectorAll('.alert');
alertList.forEach(function (alert) {
    new bootstrap.Alert(alert);
});
function closeAlert() {
    let alertNode = document.querySelector('.alert');
    let alert = bootstrap.Alert.getInstance(alertNode);
    alert.close();
}
setTimeout(closeAlert, delay);
