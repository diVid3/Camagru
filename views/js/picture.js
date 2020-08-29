const picture = document.getElementsByClassName('image')[0];
const pictureId = picture.getAttribute('id');

const commentBox = document.getElementById('comment');
const commentButton = document.getElementById('commentButton');
const commentForm = document.getElementById('commentForm');

const likeCount = document.getElementById('likeCount');
const likeImage = document.getElementById('likeImage');

commentButton.addEventListener('click', onCommentSubmit);
likeImage.addEventListener('click', onLikeClick);

function onCommentSubmit(e) {

  e.preventDefault();

  const commentText = commentBox.value;

  if (!commentText) {
    return;
  }

  const formData = new FormData();

  formData.append('text', commentText);
  formData.append('pictureId', pictureId);

  fetch(`/comment/create`, {
    method: 'POST',
    body: formData
  })
  .then((res) => res.json())
  .then((json) => {

    if (!json.success) {
      return;
    }

    const username = json.data.username;

    const commentContainer = document.createElement('div');
    commentContainer.setAttribute('class', 'comment');

    const imageDiv = document.createElement('div');
    const img = document.createElement('img');
    img.setAttribute('src', '/assets/icons/user-somewhat-blue.png');
    imageDiv.appendChild(img);

    const commentDiv = document.createElement('div');

    const commentHeading = document.createElement('h3');
    commentHeading.innerText = username;

    const commentParagraph = document.createElement('p');
    commentParagraph.innerText = commentText;

    commentDiv.appendChild(commentHeading);
    commentDiv.appendChild(commentParagraph);

    commentContainer.appendChild(imageDiv);
    commentContainer.appendChild(commentDiv);

    commentForm.parentNode.insertBefore(commentContainer, commentForm.nextSibling);

    commentBox.value = '';
  });
}

function onLikeClick(e) {

  fetch(`/like/edit/${pictureId}`, {
    method: 'GET'
  })
  .then((res) => res.json())
  .then((json) => {

    if (!json.success) {
      return;
    }

    let likes = likeCount.innerText - 0;

    if (json.data.likeState === 'liked') {

      likes += 1;
      likeCount.innerText = likes + '';
      likeImage.setAttribute('src', '/assets/icons/heart.svg');
    }

    if (json.data.likeState === 'unliked') {

      likes -= 1;
      likeCount.innerText = likes + '';
      likeImage.setAttribute('src', '/assets/icons/heart-black.svg');
    }
  });
}
