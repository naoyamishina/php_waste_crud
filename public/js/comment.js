window.addEventListener('DOMContentLoaded', function () {
  $(function () {
    const submitButton = document.querySelector('#comment_submit');
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
      fetch(url, options);
      location.reload();
    });
  });
});
