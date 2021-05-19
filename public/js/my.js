function toDateString(date) {
    date = new Date(date);
    return date.toDateString();
}

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('button').click(function () {
        let html;
        let id = $('#idCustomer');

        let name = $('#nameCustomer');
        let address = $('#addressCustomer');
        let phone = $('#phoneCustomer');

        let btnClose = $('.btn-close');

        switch ($(this).text()) {
            case "Tạo":

                $('#titleAddCustomer').show();
                $('#titleEditCustomer').hide();
                $('#titleShowCustomer').hide();
                $('#titleDeleteCustomer').hide();
                $('#bodyAddAndEditCustomer').show();
                $('#bodyShowCustomer').hide();
                $('#bodyDeleteCustomer').hide();
                $('#btnAddCustomer').show();
                $('#btnUpdateCustomer').hide();
                $('#btnDeleteCustomer').hide();

                break;
            case "Thêm":
                btnClose.trigger('click');
                $.ajax({
                    url: window.origin + "/create",
                    method: 'POST',
                    data: {
                        name: name.val(),
                        address: address.val(),
                        phone: phone.val()
                    },
                    success: function (res) {
                        html = "<tr>";
                        html += "<th scope=\"row\">" + res.id + "</th>";
                        html += "<td>" + res.name + "</td>";
                        html += "<td>" + res.address + "</td>";
                        html += "<td>" + res.phone + "</td>";
                        html += "<td>";
                        html += "<button type=\"button\" class=\"btn btn-primary show\" id=\"show_" + res.id + "\" data-bs-toggle=\"modal\" data-bs-target=\"#modal\">Xem</button>";
                        html += "<button type=\"button\" class=\"btn btn-secondary edit\" id=\"edit_" + res.id + "\" data-bs-toggle=\"modal\" data-bs-target=\"#modal\">Sửa</button>";
                        html += "<button type=\"button\" class=\"btn btn-danger delete\" id=\"delete_" + res.id + "\">Xóa</button>";
                        html += "</td>";
                        html += "</tr>";

                        $('#content').append(html);

                        name.val('');
                        address.val('');
                        phone.val('');
                    },
                    error: function (err) {

                    }
                })
                break;
            case "Xem":
                $.ajax({
                    url: window.origin + "/show/" + $(this).attr('id').slice(5),
                    method: 'GET',
                    success: function (res) {
                        console.log(res);

                        $('#titleAddCustomer').hide();
                        $('#titleEditCustomer').hide();
                        $('#titleShowCustomer').show();
                        $('#titleDeleteCustomer').hide();
                        $('#bodyAddAndEditCustomer').hide();
                        $('#bodyShowCustomer').show();
                        $('#bodyDeleteCustomer').hide();
                        $('#btnAddCustomer').hide();
                        $('#btnUpdateCustomer').hide();
                        $('#btnDeleteCustomer').hide();

                        $('#showCustomerCreatedDate').text(toDateString(res.created_at));
                        $('#showCustomerName').text(res.name);
                        $('#showCustomerAddress').text(res.address);
                        $('#showCustomerPhone').text(res.phone);

                    },
                    error: function (err) {

                    }
                })
                break;
            case "Sửa":
                let idEdit = $(this).attr('id').slice(5);
                $.ajax({
                    url: window.origin + "/show/" + idEdit,
                    method: 'GET',
                    success: function (res) {

                        id.val(idEdit);
                        name.val(res.name);
                        address.val(res.address);
                        phone.val(res.phone);

                        $('#titleAddCustomer').hide();
                        $('#titleEditCustomer').show();
                        $('#titleShowCustomer').hide();
                        $('#titleDeleteCustomer').hide();
                        $('#bodyAddAndEditCustomer').show();
                        $('#bodyShowCustomer').hide();
                        $('#bodyDeleteCustomer').hide();
                        $('#btnAddCustomer').hide();
                        $('#btnUpdateCustomer').show();
                        $('#btnDeleteCustomer').hide();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
                break;
            case "Lưu":
                btnClose.trigger('click');
                $.ajax({
                    url: window.origin + "/update/" + id.val(),
                    method: 'POST',
                    data: {
                        id: id.val(),
                        name: name.val(),
                        address: address.val(),
                        phone: phone.val()
                    },
                    success: function (res) {

                        $('#' + 'customerName_' + res.id).text(res.name);
                        $('#' + 'customerAddress_' + res.id).text(res.address);
                        $('#' + 'customerPhone_' + res.id).text(res.phone);

                        id.val('');
                        name.val('');
                        address.val('');
                        phone.val('');
                    },
                    error: function (err) {

                    }
                })
                break;
            case "Xóa":
                if ($(this).attr('id') === 'btnDeleteCustomer'){
                    $.ajax({
                        url: window.origin + "/delete/" + id.val(),
                        method: 'GET',
                        success: function (res) {
                            $("#"+"row_"+id.val()).remove();
                            btnClose.trigger('click');
                        },
                        error: function (err) {
                            console.error(err);
                        }
                    })
                }else {
                    let idDelete = $(this).attr('id').slice(7);
                    id.val(idDelete);
                    $('#titleAddCustomer').hide();
                    $('#titleEditCustomer').hide();
                    $('#titleShowCustomer').hide();
                    $('#titleDeleteCustomer').show();
                    $('#bodyAddAndEditCustomer').hide();
                    $('#bodyShowCustomer').hide();
                    $('#bodyDeleteCustomer').show();
                    $('#btnAddCustomer').hide();
                    $('#btnUpdateCustomer').hide();
                    $('#btnDeleteCustomer').show();
                    $('#nameCustomerDelete').text(idDelete);
                }
                break;
        }
    });
});
