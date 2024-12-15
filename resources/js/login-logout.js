import $ from 'jquery';

window.$ = window.jQuery = $;

$(document).ready(function () {
    //login
    const locale = $('html').attr('lang') || 'ru';
    function showAlert(message, isError = false) {
        if (isError) {
            alert(`Ошибка: ${message}`);
        } else {
            alert(message);
        }
    }

    $('.login-as-user').on('click', function () {
        const userId = $(this).data('user-id');
        $.ajax({
            url: '/user/login',
            type: 'POST',
            data: {
                user_id: userId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showAlert(response.message);
                window.location.href = response.redirect_url;
            },
            error: function(error) {
                console.log('Ошибка при авторизации');
            }
        });
    });
    //logout
    $('.logout-user').on('click', function () {
        $.ajax({
            url: '/user/logout',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showAlert(response.message);
                window.location.href = response.redirect_url;
            },
            error: function(error) {
                console.log('Ошибка при логауте');
            }
        });
    });
});
