document.addEventListener('DOMContentLoaded', function() {
    //
    const loginBtn = document.getElementById('login-button')
    const registerBtn = document.getElementById('register-button')
    const submitBtn = document.getElementById('submit-button')
    //
    const loginForm = document.querySelector('.login-form')
    const registerForm = document.querySelector('.register-form')
    //
    function showLoginForm() {
        loginForm.style.display = 'block'
        registerForm.style.display = 'none'
        submitBtn.textContent = 'Zaloguj'
        document.title = "Logowanie"
        loginBtn.classList.add('active')
        registerBtn.classList.remove('active')
    }
    function showRegisterForm() {
        registerForm.style.display = 'block'
        loginForm.style.display = 'none'
        submitBtn.textContent = 'Zarejestruj'
        document.title = "Rejestracja"
        registerBtn.classList.add('active')
        loginBtn.classList.remove('active')
    }
    loginBtn.addEventListener('click', showLoginForm)
    registerBtn.addEventListener('click', showRegisterForm)
    //
    submitBtn.addEventListener('click', () => {
        if(submitBtn.innerHTML == "Zarejestruj") {
            const email = registerForm.querySelector('input[name="email"]')?.value
            const pseudonim = registerForm.querySelector('input[name="pseudonim"]')?.value
            const haslo = registerForm.querySelector('input[name="password"]')?.value
            //
            if(!email || email.length == 0) return alert("Uzupełnij e-mail!")
            if(!pseudonim || pseudonim.length == 0) return alert("Uzupełnij pseudonim!")
            if(!haslo || haslo.length == 0) return alert("Uzupełnij haslo!")
            //
            const dane = {
                email: email,
                pseudonim: pseudonim,
                password: haslo
            }
            //
            fetch("../php/rejestracja.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dane)
            }).then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    throw new Error('Błąd sieci!')
                }
            }).then(text => {
                if(text.startsWith("Success")) {
                    alert("Pomyślnie stworzono konto. Prosimy o zalogowanie!")
                    return location.reload()
                } else {
                    alert(text)
                }
            }).catch(error => {
                console.error(error)
            })
        } else if(submitBtn.innerHTML == "Zaloguj") {
            const email = loginForm.querySelector('input[name="email"]')?.value
            const haslo = loginForm.querySelector('input[name="password"]')?.value
            //
            if(!email || email.length == 0) return alert("Uzupełnij e-mail!")
            if(!haslo || haslo.length == 0) return alert("Uzupełnij haslo!")
            //
            const dane = {
                email: email,
                password: haslo
            }
            //
            fetch("../php/login.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dane)
            }).then(response => {
                if (response.ok) {
                    return response.text()
                } else {
                    throw new Error('Błąd sieci!')
                }
            }).then(text => {
                if(text.startsWith("Success")) {
                    alert("Pomyślnie zalogowano!")
                    window.location.href = `${window.location.pathname}/../konto.php`
                } else {
                    alert(text)
                }
            }).catch(error => {
                console.error(error)
            })
        }
    })
    //
})