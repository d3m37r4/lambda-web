document.getElementById('confirmDelete').addEventListener('show.bs.modal', function (event) {
    let btn = event.relatedTarget;
    this.querySelector('.modal-title').textContent = btn.getAttribute('data-modal-title');
    this.querySelector('.modal-message').textContent = btn.getAttribute('data-modal-message');
    this.querySelector('.modal-route').action = btn.getAttribute('data-modal-route');
});
