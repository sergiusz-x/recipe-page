document.addEventListener('DOMContentLoaded', function() {
    //
    // Obsługa logowania i rejestracji
    const loginBtn = document.getElementById('login-button');
    const registerBtn = document.getElementById('register-button');
    const submitBtn = document.getElementById('submit-button');
    //
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');
    //
    function showLoginForm() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        submitBtn.textContent = 'Zaloguj';
        document.title = "Logowanie";
        loginBtn.classList.add('active');
        registerBtn.classList.remove('active');
    }
    function showRegisterForm() {
        registerForm.style.display = 'block';
        loginForm.style.display = 'none';
        submitBtn.textContent = 'Zarejestruj';
        document.title = "Rejestracja";
        registerBtn.classList.add('active');
        loginBtn.classList.remove('active');
    }
    loginBtn.addEventListener('click', showLoginForm);
    registerBtn.addEventListener('click', showRegisterForm);

});