window.addEventListener('DOMContentLoaded', function () {
  $(function () {
    const form = document.querySelector('#comment_form');

    form.addEventListener('submit', async(event) => {
      event.stopPropagation();
      event.preventDefault();
      let formData;
      formData = new FormData(form);
      const options = {
        method: 'POST',
        body: formData,
      }
      const url = form.getAttribute('action');
      fetch(url, options)
        .then(response => response.json())
        .then(data => {
          // コメント一覧を更新する
          const commentList = document.getElementById('comment-list');
          const commentValidationList = document.getElementById('comment-validation');
          const commentBody = document.getElementById('comment-body');
          commentValidationList.innerHTML = '';
          commentBody.value = '';
          const listItem = document.createElement('div');
          const html = `
          <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg mt-8 whitespace-pre-line">
          ${data.body}
          <div class="text-sm font-semibold flex flex-row-reverse">
          </div>
          </div>
          `;

          listItem.innerHTML = html;
          commentList.appendChild(listItem);
        })
        .catch(error => {
          const commentValidationList = document.getElementById('comment-validation');
          commentValidationList.innerHTML = '';
          const listItem = document.createElement('div');
          const html = `
          <div class="mt-8 text-red-600"> コメントを入力してください </div>
          `;

          listItem.innerHTML = html;
          commentValidationList.appendChild(listItem);
        });
    });
  });
});
