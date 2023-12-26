$(".sortline").change(function (event) {
    event.preventDefault();
    var form = $(this).closest('form')[0];
    var formData = new FormData(form);
    $('body').addClass('loading_body');
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            location.reload();
        },
        error: function () {
            console.log("Произошла ошибка при отправке запроса.");
        }
    });
});