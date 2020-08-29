const pictures = document.querySelectorAll('.picture');

pictures.forEach((element) => element.addEventListener('click', onClick));

function onClick(e) {

  const pictureId = e.target.id;
  window.location.href = `http://localhost:8080/picture/show/${pictureId}`;
}
