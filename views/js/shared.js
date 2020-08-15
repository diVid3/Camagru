function displayBoxMessage(
  errorBox,
  message,
  seconds = 3,
  callback = _ => {}
) {

  errorBox.innerHTML = message;
  errorBox.style.display = 'block'

  setTimeout(() => {

    errorBox.innerHTML = '';
    errorBox.style.display = 'none';
    callback();
  }, seconds * 1000);
}
