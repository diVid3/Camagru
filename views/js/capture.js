const canvas = document.getElementById('canvas');
const video = document.getElementById('video');

// Sticker buttons
const flowers = document.getElementById('flowers');
const unicorn = document.getElementById('unicorn');
const sun = document.getElementById('sun');

// Sticker checkboxes
const flowersCheckbox = document.getElementById('flowers-checkbox');
const unicornCheckbox = document.getElementById('unicorn-checkbox');
const sunCheckbox = document.getElementById('sun-checkbox');

flowersCheckbox.addEventListener('click', onCheckboxClick(flowersCheckbox, flowers));
unicornCheckbox.addEventListener('click', onCheckboxClick(unicornCheckbox, unicorn));
sunCheckbox.addEventListener('click', onCheckboxClick(sunCheckbox, sun));

// Buttons
const captureButton = document.getElementById('capture');
const uploadButton = document.getElementById('upload');
const clearButton = document.getElementById('clear');
const saveButton = document.getElementById('save');

captureButton.addEventListener('click', onCapturePress);
uploadButton.addEventListener('click', onUploadPress);
clearButton.addEventListener('click', onClearPress);
saveButton.addEventListener('click', onSavePress);

// File
const fileInput = document.getElementById('file');
fileInput.addEventListener('change', onFileSelect);

// Picture bar
const pictureBar = document.getElementById('picture-bar');

// State
let didCapture = false;

// Actions
navigator.mediaDevices.getUserMedia({video: { width: 640, height: 480 }, audio: false})
.then(function(stream) {
  video.srcObject = stream;
  video.play();
})
.catch(function(e) {
  console.error(e);
});

addOnDeleteToDeleteButtons();

// Functions
function showSticker(checkbox, sticker) {

  checkbox.setAttribute('checked', 'true');
  checkbox.checked = true;
  sticker.style.display = 'block';
};

function removeSticker(checkbox, sticker) {

  checkbox.removeAttribute('checked');
  checkbox.checked = false;
  sticker.style.display = 'none';
};

function onCheckboxClick(checkbox, sticker) {

  return function() {

    const isChecked = checkbox.hasAttribute('checked');

    if (!isChecked) {

      showSticker(checkbox, sticker);
      return;
    }
  
    if (isChecked) {

      removeSticker(checkbox, sticker);
      return;
    }
  }
}

function onCapturePress() {

  const width = 640;
  const height = 480;

  canvas.width = width;
  canvas.height = height;

  const context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, width, height);
  
  video.style.display = 'none';
  canvas.style.display = 'block';

  didCapture = true;
}

function onUploadPress() {
  fileInput.click();
}

function onClearPress() {

  didCapture = false;

  removeSticker(flowersCheckbox, flowers);
  removeSticker(unicornCheckbox, unicorn);
  removeSticker(sunCheckbox, sun);

  video.style.display = 'initial';
  canvas.style.display = 'none';
  fileInput.value = '';
}

function onSavePress() {

  if (!didCapture) {
    return;
  }

  const picture = canvas.toDataURL('image/png');
  const form = new FormData();

  form.append('picture', picture);
  appendStickers(form);

  sendForm(form);
  onClearPress();
}

function onFileSelect() {

  const file = fileInput.files[0];
  const form = new FormData();

  form.append('file', file);
  appendStickers(form);

  sendForm(form);
  onClearPress();
}

function appendStickers(form) {

  if (!form) {
    return;
  }

  if (flowersCheckbox.hasAttribute('checked') && flowersCheckbox.checked === true) {
    form.append('flowers', true);
  }

  if (unicornCheckbox.hasAttribute('checked') && unicornCheckbox.checked === true) {
    form.append('unicorn', true);
  }

  if (sunCheckbox.hasAttribute('checked') && sunCheckbox.checked === true) {
    form.append('sun', true);
  }
}

function sendForm(formData) {

  fetch('/capture/create', {
    method: 'POST',
    body: formData
  })
  .then((res) => res.json())
  .then((json) => {

    if (!json.success) {
      return;
    }

    const picture = document.createElement('img');
    const card = document.createElement('div');
    const deleteButton = document.createElement('button');

    picture.setAttribute('id', json?.data?.picture?.id);
    picture.setAttribute('src', json?.data?.picture?.path);

    deleteButton.setAttribute('class', 'delete-button');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', onDelete);

    card.appendChild(deleteButton);
    card.appendChild(picture);

    pictureBar.insertBefore(card, pictureBar.firstChild);
  });
}

function onDelete(e) {

  const pictureToDelete = e.target.nextSibling;
  const idToDelete = pictureToDelete.getAttribute('id');

  const formData = new FormData();

  if (!idToDelete) {
    return;
  }

  fetch(`/picture/delete/${idToDelete}`, {
    method: 'POST',
    body: formData
  })
  .then((res) => res.json())
  .then((json) => {

    if (!json.success) {
      return;
    }

    pictureToDelete?.parentNode?.remove();
  });
}

function addOnDeleteToDeleteButtons() {

  document.querySelectorAll('.delete-button')
    .forEach((element) => element.addEventListener('click', onDelete));
}
