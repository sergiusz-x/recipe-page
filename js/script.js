document.addEventListener('DOMContentLoaded', function() {
    const navbarSearch = document.querySelector('.navbar-search');

    function toogle_class(element, state, class_name) {
        if(state) {
            if(!element.classList.contains(class_name)) {
                element.classList.add(class_name);
            }
        } else {
            if(element.classList.contains(class_name)) {
                element.classList.remove(class_name);
            }
        }
    }

    // Usuwanie search baru jeśli się już nie mieści
    window.addEventListener('resize', () => {
        if (window.innerWidth > 767) {
            toogle_class(navbarSearch, false, "navbar-search-closed");
        } else {
            toogle_class(navbarSearch, true, "navbar-search-closed");
        }
    });
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