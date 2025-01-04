document.getElementById('contact-form').addEventListener('submit', function (event) {
  // Prevent form submission
  event.preventDefault();

  // Clear previous error messages
  document.querySelectorAll('.error-message').forEach(function (el) {
    el.textContent = '';
  });

  // Get form values
  var firstName = document.getElementById('first-name').value.trim();
  var lastName = document.getElementById('last-name').value.trim();
  var email = document.getElementById('email').value.trim();
  var mobileNumber = document.getElementById('mobile-number').value.trim();
  var description = document.getElementById('description').value.trim();

  // Email validation pattern
  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  // Mobile number validation pattern
  var mobilePattern = /^[0-9]{10}$/;

  // Error messages
  var errors = false;

  if (!firstName) {
    document.getElementById('first-name-error').textContent = "First name is required*";
    errors = true;
  }

  if (!email) {
    document.getElementById('email-error').textContent = "Email is required*";
    errors = true;
  } else if (!emailPattern.test(email)) {
    document.getElementById('email-error').textContent = "Invalid email*";
    errors = true;
  }

  if (!mobileNumber) {
    document.getElementById('mobile-number-error').textContent = "Mobile number is required*";
    errors = true;
  } else if (!mobilePattern.test(mobileNumber)) {
    document.getElementById('mobile-number-error').textContent = "Invalid mobile number*";
    errors = true;
  }

  // If no errors, submit the form
  if (!errors) {
    // alert("Form submitted successfully!");
    // Optionally, you can submit the form programmatically here
    document.getElementById('contact-form').submit();
  }
});
document.getElementById('mobile-number').addEventListener('input', function (event) {
  this.value = this.value.replace(/[^0-9]/g, '');
});

$(document).ready(function () {
  $('.select-code').select2();
});
