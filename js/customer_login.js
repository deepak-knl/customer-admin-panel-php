$(document).ready(function () {
    $('#customerLoginForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        $('.text-danger').remove();

        // Get form values
        let phone = $('#phone').val().trim();
        let password = $('#password').val().trim();
        let isValid = true;

        // Frontend validation
        if (phone === '') {
            $('#ph').after('<span class="text-danger">Phone number is required.</span>');
            isValid = false;
        }

        if (password === '') {
            $('#pass').after('<span class="text-danger">Password is required.</span>');
            isValid = false;
        }

        // If validation passes, proceed with AJAX
        if (isValid) {
            $.ajax({
                url: './login_process.php',
                type: 'POST',
                data: { mobile_number: phone, password: password },
                success: function (response) {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        // Redirect to a dashboard or another page on success
                        window.location.href = '../pages/profile.php';
                    } else {
                        // Handle server error messages
                        if (result.message.invalid) {
                            let error = $(`<span class="text-danger">${result.message.invalid}</span>`);
                            $('#ph').after(error);
                        }
                        if (result.message.invalidMob) {
                            let error = $(`<span class="text-danger">${result.message.invalidMob}</span>`);
                            $('#ph').after(error);
                        }
                        if (result.message.passEmpty) {
                            let error = $(`<span class="text-danger">${result.message.passEmpty}</span>`);
                            $('#pass').after(error);
                        }
                        if (result.message.invalidPass) {
                            let error = $(`<span class="text-danger">${result.message.invalidPass}</span>`);
                            $('#pass').after(error);
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
