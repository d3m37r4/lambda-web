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

// Passing the route and name of user being deleted to body of modal window
let modalDeleteUser = document.getElementById('confirmDelete');
modalDeleteUser.addEventListener('show.bs.modal', function (event) {
    let btn = event.relatedTarget;
    this.querySelector('.route').action = btn.getAttribute('data-route');

    let msg = document.querySelector('.data-modal-msg').value;
    let name = btn.getAttribute('data-username');

    msg = msg.replace('@username', name);
    this.querySelector('.modal-msg').textContent = msg;
});

// Passing the route and name of role being deleted to body of modal window
let modalDeleteRole = document.getElementById('confirmDeleteRole');
modalDeleteRole.addEventListener('show.bs.modal', function (event) {
    let btn = event.relatedTarget;
    this.querySelector('.route-delete-role').action = btn.getAttribute('data-route-delete-role');

    let msg = document.querySelector('.msg-confirm-delete-role').value;
    let name = btn.getAttribute('data-rolename');

    msg = msg.replace('@rolename', name);
    this.querySelector('.replace-msg-confirm-delete-role').textContent = msg;
});
