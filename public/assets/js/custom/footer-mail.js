document.getElementById('subscribe-btn').addEventListener('click', function (event) {
  event.preventDefault(); // Prevent the default button behavior
  var emailInput = document.getElementById('email-input');
  // Clear the input field
  emailInput.value = '';
});