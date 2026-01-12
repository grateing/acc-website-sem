function showPassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.toggle-password');
    if (passwordInput) {
        passwordInput.type = 'text';
        toggleButton.classList.add('active');
    }
}

function hidePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.toggle-password');
    if (passwordInput) {
        passwordInput.type = 'password';
        toggleButton.classList.remove('active');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.toggle-password');
    if (toggleButton) {
        toggleButton.addEventListener('mousedown', showPassword);
        toggleButton.addEventListener('mouseup', hidePassword);
        toggleButton.addEventListener('mouseleave', hidePassword);
        toggleButton.addEventListener('touchstart', showPassword);
        toggleButton.addEventListener('touchend', hidePassword);
    }
});

function showForm(formId) {
    document.querySelectorAll(".login-container").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}