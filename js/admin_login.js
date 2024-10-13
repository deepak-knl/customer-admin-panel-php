$(document).ready(function () {
    $('#userLoginForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        $('.text-danger').remove();

        // Get form values
        let email = $('#email').val().trim();
        let password = $('#password').val().trim();
        let isValid = true;

        // Frontend validation
        if (email === '') {
            $('#mail').after('<span class="text-danger">Email address is required.</span>');
            isValid = false;
        } else {
            // Validate email format
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                $('#mail').after('<span class="text-danger">Invalid email format.</span>');
                isValid = false;
            }
        }

        if (password === '') {
            $('#pass').after('<span class="text-danger">Password is required.</span>');
            isValid = false;
        }

        // If validation passes, proceed with AJAX
        if (isValid) {
            $.ajax({
                url: './admin_login_process.php',
                type: 'POST',
                data: { email_address: email, password: password },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        window.location.href = '../pages/dashboard.php';
                    } else {
                        // Handle server error messages
                        if (result.message) {
                            for (let key in result.message) {
                                let error = $(`<span class="text-danger">${result.message[key]}</span>`);
                                if (key === 'invalidMail' || key === 'invalid') {
                                    $('#mail').after(error);
                                } else if (key === 'passEmpty' || key === 'invalidPass') {
                                    $('#pass').after(error);
                                }
                            }
                        }
                    }
                },
                error: function () {
                    alert('An error occurred while processing your request.');
                }
            });
        }
    });
});
