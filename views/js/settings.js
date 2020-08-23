const settingsForm = document.getElementById('settingsForm');
const errorBox = document.getElementById('errorBox');
const notificationBox = document.getElementById('notificationBox');

settingsForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const canNotify = document.getElementById('canNotify').checked;

  if (password !== confirmPassword) {
    return displayBoxMessage(errorBox, 'Your passwords do not match', 3);
  }

  const formData = new FormData();

  formData.append('username', username);
  formData.append('password', password);
  formData.append('canNotify', canNotify);

  fetch('/settings/edit', {
    method: 'POST',
    body: formData
  })
  .then((res) => res.json())
  .then((json) => {

    if (json.success !== true) {
      return displayBoxMessage(errorBox, json.message, 5);
    }

    displayBoxMessage(notificationBox, json.message, 3, () => {
      return window.location.href = 'http://localhost:8080/login/show';
    });
  });
});
