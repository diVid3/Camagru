const loginForm = document.getElementById('loginForm');
const errorBox = document.getElementById('errorBox');

loginForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const formData = new FormData();

  formData.append('email', email);
  formData.append('password', password);

  fetch('/login/create', {
    method: 'POST',
    body: formData
  })
  .then((res) => res.json())
  .then((json) => {

    if (json.success !== true) {
      return displayBoxMessage(errorBox, json.message, 3);
    }

    return window.location.href = 'http://localhost:8080/gallery/show';
  });
});
