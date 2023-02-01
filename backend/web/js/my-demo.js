//Удаление картинки
function removeImageStock(id) {

    $.ajax({
        type: "get",
        url: "/shop-admin/product-list/remove-image",
        data: {id: id},
        success: function (data) {
            $("#images-table").load(window.location.href + ' #images-table > *');
            // $.pjax.reload({ container: '#images-table' });
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

function partAddToggle(id, application_id) {

    $.ajax({
        url: '/shop-admin/crm/application/add-part-ajax',
        type: 'get',
        data: {
            id: id,
            application_id: application_id
        },
        success: function (res) {
            // console.log('success', res);
            $.pjax.reload({container: '#crud-datatable-pjax'});
            // if (res.success === 'true') {
            //     $("#applications-user").load("/shop-admin/app/default/res-application?" + $.param({
            //         id_user: res.id_user,
            //     }));
            // }

        },
        error: function (res) {
            console.log('errors', res);
            $.pjax.reload({container: '#crud-datatable-pjax'});
        }
    });


}


function partAddRnToggle(id, application_id) {

    $.ajax({
        url: '/shop-admin/crm/application/add-part-rn-ajax',
        type: 'get',
        data: {
            id: id,
            application_id: application_id
        },
        success: function (res) {
            // console.log('success', res);
            $.pjax.reload({container: '#crud-datatable-pjax'});
            // if (res.success === 'true') {
            //     $("#applications-user").load("/shop-admin/app/default/res-application?" + $.param({
            //         id_user: res.id_user,
            //     }));
            // }

        },
        error: function (res) {
            console.log('errors', res);
            $.pjax.reload({container: '#crud-datatable-pjax'});
        }
    });


}

function removeApplication(id) {
    if (window.confirm("Дейстивительно удалить?")) {
        $.ajax({
            url: '/shop-admin/crm/application/remove',
            type: 'get',
            data: {id: id},
            success: function (data) {
                if (data.success) {
                    $("#data-table").load(window.location.href + " #data-table");
                } else {
                    alert(response.message);
                }
            }
        });
    }
}

function dublicateApplication(id) {
    if (window.confirm("Дейстивительно копировать без З/Ч и Фото?")) {
        $.ajax({
            url: '/shop-admin/crm/application/copy-application',
            type: 'get',
            data: {application_id: id},
            success: function (data) {
                if (data.success) {
                    $("#data-table").load(window.location.href + " #data-table");
                } else {
                    alert(response.message);
                }
            }

        });
    }
}

function removeBinotelCall(id) {
    $.ajax({
        url: '/shop-admin/app/default/remove-binotel-call',
        type: 'get',
        data: {id: id},
        success: function (data) {
            if (data.success) {
                $("#call-" + id).remove();
                $("#applications-user").load("/shop-admin/app/default/res-application?" + $.param({
                    id_user: data.id_user,
                }));
                // $( "#applications-user").remove();
                // $.pjax.reload({ container: '#call-table', async: false });
                // $("#call-table").load(window.location.href + " #call-table" );
            } else {
                alert(response.message);
            }
        }
    });
}


function searchPhone(id) {
    // alert(id);
    $('.spinner').css("display", "block");
    let tr = $('#call-' + id).css("background", "gold");
    $.ajax({
        url: '/shop-admin/app/default/application-binotel-call',
        type: 'get',
        data: {
            id: id,
        },
        success: function (res) {
            $('.spinner').css("display", "none");
            if (res.success === 'true') {
                $("#applications-user").load("/shop-admin/app/default/res-application?" + $.param({
                    id_user: res.id_user,
                }));
                console.log('success', res);
            } else {
                $("#applications-user").load("/shop-admin/app/default/res-application?" + $.param({
                    id_user: res.id_user,
                }));
                console.log('error', res);
            }

        },
        error: function (res) {
            console.log('errors', res);
        }
    });
}

/**
 *
 * @param {*} id
 * робота з СФ в заказах
 */
function checkOrder(id) {
    var idCheck = document.getElementById('sf-' + id);

    // console.log('id', idCheck);
    // idCheck.checked = true;
    // idCheck.dataset.checked = true;
    $.ajax({
        url: '/shop-admin/crm/order-parts-listed/check-order',
        type: 'get',
        data: {id: id},
        success: function (data) {
            console.log('success', data);
            var waybill = parseFloat($('#partsapplicationmodel-waybill').val(data.order.waybill)); // РН
            var invoice = parseFloat($('#partsapplicationmodel-invoice').val(data.order.invoice)); // СФ
            var provider = parseFloat($('#partsapplicationmodel-provider_id').val(data.order.supplier_part_id)); // поставщик
            // var quantity = parseFloat($('#partsapplicationmodel-quantity').val()); // quantity
            var quantityId = document.getElementById('partsapplicationmodel-quantity');
            var orderId = quantityId.dataset.orderId = data.order.id;
            console.log('orderId', orderId);
        },
        error: function (data) {
            console.log('errors', data);

        }
    });
}


/**
 *
 *
 * робота з СФ в заказах с количеством
 */
function quantityOrder() {
    // alert('вызвано id' + id);
    var quantityId = document.getElementById('partsapplicationmodel-quantity');
    var quantityVal = parseFloat($('#partsapplicationmodel-quantity').val()); // quantity
    var orderId = quantityId.dataset.orderId;// data order id

    console.log('quantityVal', quantityVal);
    console.log('orderId', orderId);

    // $.ajax({
    //     url:'/shop-admin/crm/order-parts-listed/quantity-order',
    //     type:'get',
    //     data:{id:id},
    //     success:function(data){
    //         console.log('success', data);
    //         var quantity = parseFloat($('#partsapplicationmodel-quantity').val()); // quantity

    //     },
    //     error: function (data) {
    //         console.log('errors', data);

    //     }
    // });

}


function binotelCall() {
    setTimeout(function () {
            $.ajax({
                // url:'/shop-admin/app/default/binotel-call',
                url: '/api/binotel/count-call',
                type: 'get',
                success: function (data) {

                    // console.log('binotel success', data);
                    // console.log('binotel count', data.count);

                    $('.call-count').html(data.count);

                    if (data.resTime < 2) {
                        // if (data.isNewCall == 'Звонки были ранее') {
                        if (data.applications && data.user) {
                            //https://kamranahmed.info/toast#quick-demos
                            $.toast({
                                loader: true,
                                hideAfter: 30000,
                                position: 'top-right',
                                heading: '<h2>Входящий звонок <br>' + data.isNewCall + '</h2>',
                                text: '<ul>' +
                                        '<li>Заявка № <a href="/shop-admin/crm/application/update?id=' + data.applications.id + '" target="_blank" style="text-decoration:none; padding-bottom: 0px">' + data.applications.bid_number + '</a></li>' +
                                        '<li>ФИО: ' + data.user.fio + '</li>' +
                                        '<li>Телефон: ' + data.user.phone + '</li>' +
                                        '<li>Бренд: ' + data.applications.brand + '</li>' +
                                        '<li>Изделие: ' + data.applications.naimenovaniye_izdeliya + '</li>' +
                                    '</ul>',
                                bgColor: "#4949ec",
                                textColor: 'white',
                                icon: false
                            });
                            // }
                        } else {
                            $.toast({
                                loader: true,
                                hideAfter: 10000,
                                position: 'top-right',
                                heading: '<h2>Входящий звонок <br>' + data.isNewCall + '</h2>',
                                text: '<ul>' +
                                    '<li>Телефон: ' + data.count_old.phone + '</li>' +
                                    '</ul>',
                                bgColor: "#4949ec",
                                textColor: 'white',
                                icon: false
                            });
                        }

                    }
                    setTimeout(binotelCall, 1000);
                },
                error: function (data) {
                    console.log('binotel errors', data);

                }
            });
        }

        ,
        500
    )
    ;
}

setTimeout(binotelCall, 1000);
//render-models


// function copyText(text){

//     var content = document.getElementById('st-copy');

//     content.select();
//     document.execCommand('copy');

//     alert("Copied!");
// }