document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    const loginError = document.getElementById('login-error');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        /*if(email === 'test@example.com' && password === 'password123'){
            window.location.href ='dashboard.html';
        }else{
            loginError.style.display = 'block';
        }*/

        try {
            //Enviar la solicitud al servidor
            const response = await fetch('backend/login.php', {//await significa esperar el resultado
                method: 'POST',
                header: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ email: email, password: password })
            });
            //manejo de la respuesta
            const result = response.json();

            if (response.ok) {
                //login exitoso, redirigir al usuario al dashboard
                window.location.href = "dashboard.html";
            }else{
                loginError.style.display = 'block';
                loginError.textContent = result.error || 'Invalid username or password';
            }

        } catch (error) {
            loginError.style.display = 'block';
            loginError.textContent = 'There was an error processing your request';
        }
    });
})