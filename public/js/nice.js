function nice(postId) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/post/${postId}/nice`,
    type: "POST",
  })
    .done(function () {
      location.reload();
    })
    .fail(function (error) {
      console.log(error);
    });
}

function unnice(postId) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/post/${postId}/unnice`,
    type: "POST",
    data: {
        _method: "DELETE"
    },
  })
    .done(function () {
      location.reload();
    })
    .fail(function (error) {
      console.log(error);
    });
}
