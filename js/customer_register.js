$(document).ready(function () {
    $('#customerRegisterForm').submit(function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('.text-danger').remove();

        // Frontend Validation
        let phone = $('#phone').val().trim();
        let password = $('#password').val().trim();
        let confirmPassword = $('#confirm_password').val().trim();
        let phonePattern = /^[0-9]{10,14}$/; // Adjust if needed
        let isValid = true;

        // Validate phone number
        if (phone === '' || !phonePattern.test(phone)) {
            let error = $('<span class="text-danger">Please enter a valid phone number (10-14 digits)</span>');
            $('#ph').after(error);
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
                url: './registration_process.php',
                type: 'POST',
                data: { mobile_number: phone, password: password, confirm_password: confirmPassword },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        window.location.href = '../customer/customer_login.php';
                    } else {
                        // Handle server error messages
                        if (result.message.invalid) {
                            let error = $(`<span class="text-danger">${result.message.invalid}</span>`);
                            $('#ph').after(error);
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