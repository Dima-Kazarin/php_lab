$(document).ready(function() {
    $('#register-form').on('submit', function(e) {
        e.preventDefault();
        const username = $('#username').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirm-password').val();

        if (password !== confirmPassword) {
            $('#register-message').text('Паролі не співпадають.');
            return;
        }

        $.ajax({
            url: 'register.php',
            method: 'POST',
            data: { username, email, password },
            success: function(response) {
                $('#register-message').text(response);
                if (response.includes('успішно')) {
                    window.location.href = 'index.html';
                }
            }
        });
    });

    $('#login-form').on('submit', function(e) {
        e.preventDefault();
        const email = $('#login-email').val();
        const password = $('#login-password').val();
    
        $.ajax({
            url: 'login.php',
            method: 'POST',
            data: { email, password },
            success: function(response) {
                $('#login-message').text(response);
                if (response.trim() === 'Вхід успішний!') {
                    window.location.href = 'index.html';
                }
            },
            error: function() {
                $('#login-message').text('Сталася помилка при спробі входу.');
            }
        });
    });


    $('#profile-form').on('submit', function(e) {
        e.preventDefault();
        const newUsername = $('#update-username').val();
        const newPassword = $('#update-password').val();
        const confirmPassword = $('#update-confirm-password').val();

        if (newPassword !== confirmPassword) {
            $('#profile-message').text('Паролі не співпадають.');
            return;
        }

        $.ajax({
            url: 'update_profile.php',
            method: 'POST',
            data: { username: newUsername, password: newPassword },
            success: function(response) {
                $('#profile-message').text(response);
                window.location.href = 'index.html';
            },
            error: function() {
                $('#profile-message').text('Сталася помилка при оновленні профілю.');
            }
        });
    });
    if (window.location.pathname.endsWith('index.html')) {
        $.ajax({
            url: 'check_session.php',
            method: 'GET',
            success: function(response) {
                if (response) {
                    $('#welcome-message').text('Вітаємо, ' + response);
                    $('<button onclick="window.location.href=\'profile.html\'">Перейти в профіль</button>').appendTo('body');
                }
            }
        });
    }
});
