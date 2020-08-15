const registerForm = document.getElementById('registerForm');
const errorBox = document.getElementById('errorBox');
const notificationBox = document.getElementById('notificationBox');

registerForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const username = document.getElementById('username').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (password !== confirmPassword) {
    return displayBoxMessage(errorBox, 'Your passwords do not match', 3);
  }

  const formData = new FormData();

  formData.append('username', username);
  formData.append('email', email);
  formData.append('password', password);

  fetch('/register/create', {
    method: 'POST',
    body: formData
  })
  .then((res) => {
    return res.json();
  })
  .then((json) => {

    if (json.success !== true) {
      return displayBoxMessage(errorBox, json.message, 3);
    }

    displayBoxMessage(notificationBox, json.message, 5, () => {
      return window.location.href = 'http://localhost:8080/login/show';
    });
  });
});
