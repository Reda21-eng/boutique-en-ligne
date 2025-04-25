async function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('/controllers/UserController.php?action=login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        });
        const result = await response.json();
        if (result.success) {
            location.href = '/index.php';
        } else {
            alert('Identifiants incorrects');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

async function register() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('/controllers/UserController.php?action=register', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, email, password })
        });
        const result = await response.json();
        if (result.success) {
            location.href = '/login.php';
        } else {
            alert('Erreur lors de l\'inscription');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}

async function updateProfile() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    try {
        const response = await fetch('/controllers/UserController.php?action=update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, email })
        });
        const result = await response.json();
        if (result.success) {
            alert('Profil mis à jour');
        } else {
            alert('Erreur lors de la mise à jour');
        }
    } catch (error) {
        console.error('Erreur:', error);
    }
}