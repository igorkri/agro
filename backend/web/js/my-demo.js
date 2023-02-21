//Удаление картинки
function removeImageStock(id, land) {
    $.ajax({
        type: "get",
        url: "/admin/"+ land +"/product/remove-image",
        data: {id: id},
        success: function (data) {
            // console.log(data);
            $("#images-table").load(window.location.href + ' #images-table > *');
            // $.pjax.reload({ container: '#images' });
            // setTimeout(function () {
            //     window.location.reload();
            // }, 500);
        },
        error: function (data) {
            console.log('Error!', data);
            // alert('Error!');
        }
    })
}
