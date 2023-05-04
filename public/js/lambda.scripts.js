// Initializing alerts
let alertList = document.querySelectorAll('#alert');
alertList.forEach(function (alert) {
    new mdb.Alert(alert);
});

const alertHidingDelay = 2000;  // Delay before hiding alert
document.addEventListener("DOMContentLoaded", function() {
    // Hide alert after a specified time
    // let alert = mdb.Alert.getInstance(document.querySelector('#alert'));
    // if (alert) {
    //     setTimeout(() => {
    //         alert.close();
    //     }, alertHidingDelay);
    // }
});

// Generate token
const tokenLength = 64;
function generateToken(element, len) {
    element.value = secureRandomPassword.randomString({length: len});
}
