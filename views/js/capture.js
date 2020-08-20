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

captureButton.addEventListener('click', onCapture);
clearButton.addEventListener('click', onClear);

// Enable webcam
navigator.mediaDevices.getUserMedia({video: { width: 640, height: 480 }, audio: false})
.then(function(stream) {
  video.srcObject = stream;
  video.play();
})
.catch(function(e) {
  console.error(e);
});

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

// Take picture on click event.
// takePicButton.addEventListener('click', function(e) {
//   var context = canvas.getContext('2d');
//   if (width && height) {
//       canvas.width = width;
//       canvas.height = height;
//       context.drawImage(video, 0, 0, width, height);
//       takePicButtonClicks++;
//       document.getElementById('videoDiv').style.display = "none";
//       document.getElementById('canvasDiv').style.display = "flex";
//   }
//   e.preventDefault();
// });

function onCapture() {

  const width = 640;
  const height = 480;

  canvas.width = width;
  canvas.height = height;

  const context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, width, height);
  
  video.style.display = 'none';
  canvas.style.display = 'block';
}

function onUpload() {

}

function onClear() {

  removeSticker(flowersCheckbox, flowers);
  removeSticker(unicornCheckbox, unicorn);
  removeSticker(sunCheckbox, sun);

  video.style.display = 'initial';
  canvas.style.display = 'none';
}

function onSave() {
  
}
