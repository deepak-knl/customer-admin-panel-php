$(document).ready(function () {
    $('#userRegisterForm').submit(function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('.text-danger').remove();

        // Frontend Validation
        let email = $('#email').val().trim();
        let password = $('#password').val().trim();
        let confirmPassword = $('#confirm_password').val().trim();
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Corrected email pattern
        let isValid = true;

        // Validate email
        if (email === '' || !emailPattern.test(email)) {
            let error = $('<span class="text-danger">Please enter a valid email address (example@gmail.com)</span>');
            $('#mail').after(error);
            isValid = false;
        }

        // Validate password
        if (password === '') {
            let error = $('<span class="text-danger">Password cannot be empty</span>');
            $('#pass').after(error);
            isValid = false;
        }

        // Validate confirm password
        if (confirmPassword === '') {
            let error = $('<span class="text-danger">Please confirm your password</span>');
            $('#cpass').after(error);
            isValid = false;
        } else if (password !== confirmPassword) {
            let error = $('<span class="text-danger">Passwords do not match</span>');
            $('#cpass').after(error);
            isValid = false;
        }

        // If validation passes, proceed with AJAX
        if (isValid) {
            $.ajax({
                url: './admin_registration_process.php',
                type: 'POST',
                data: { email_address: email, password: password, confirm_password: confirmPassword },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        window.location.href = '../pages/dashboard.php';

                    } else {
                        // Handle server error messages
                        if (result.message.invalid) {
                            let error = $(`<span class="text-danger">${result.message.invalid}</span>`);
                            $('#mail').after(error);
                        }
                        if (result.message.passEmpty) {
                            let error = $(`<span class="text-danger">${result.message.passEmpty}</span>`);
                            $('#pass').after(error);
                        }
                        if (result.message.conf) {
                            let error = $(`<span class="text-danger">${result.message.conf}</span>`);
                            $('#cpass').after(error);
                        }
                        if (result.message.noMatch) {
                            let error = $(`<span class="text-danger">${result.message.noMatch}</span>`);
                            $('#cpass').after(error);
                        }
                        if (result.message.already) {
                            const alertDiv = $('.alert.alert-danger');
                            alertDiv.removeClass('d-none').text(result.message.already);
                            setTimeout(function () {
                                alertDiv.addClass('d-none');
                                alertDiv.text('');
                            }, 2000);
                        }
                        if (result.message.failed) {
                            const alertDiv = $('.alert.alert-danger');
                            alertDiv.removeClass('d-none').text(result.message.failed);
                            setTimeout(function () {
                                alertDiv.addClass('d-none');
                                alertDiv.text('');
                            }, 2000);
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error: ' + textStatus, errorThrown);
                }
            });
        }
    });
});
