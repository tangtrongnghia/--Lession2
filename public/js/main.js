//upload
$('#uploadFile').change(function () {
    $('#message-file').addClass('d-none');
    var formData = new FormData();
    formData.append('file', $('#uploadFile')[0].files[0]);
    formData.append('type', 'images');

    $.ajax({
        type: "POST",
        url: "/upload",
        data: formData,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.error) {
                $('#message-file').text(result.message).removeClass('d-none');
            } else {
                $('#thumb').val(result.url);
                $('#img').attr('src', '/' + result.url).removeClass('d-none');
            }
        }
    });
});

//new product
$('#add').click(function () {
    $('.cate-option').prop("selected", false);;
    $('#form-title').text('Add a new product');
    $('#name, #thumb').val('');
    $('#img').attr('class', 'd-none');
    $('#send').attr('onclick', `sendForm('/add')`)
    $('.text-danger').addClass('d-none');
});

function create() {
    var name = $('#name').val();
    var cateId = $('#category').val();
    var thumb = $('#thumb').val();
    $('.text-danger').addClass('d-none');

    $.ajax({
        type: "post",
        url: "/add",
        data: { name: name, categoryId: cateId, thumb: thumb },
        dataType: "JSON",
        success: function (response) {
            response.error
                ? $('#message-' + response.input).text(response.message).removeClass('d-none')
                : location.reload();
        }
    });
}

function sendForm(url) {
    var name = $('#name').val();
    var cateId = $('#category').val();
    var thumb = $('#thumb').val();
    
    $('.text-danger').addClass('d-none');

    $.ajax({
        type: "post",
        url: url,
        data: { name: name, categoryId: cateId, thumb: thumb },
        dataType: "JSON",
        success: function (response) {
            response.error
                ? $('#message-' + response.input).text(response.message).removeClass('d-none')
                : location.reload();
        }
    });
}

function showDetail(productId) {
    let result = products.find(({ id }) => id == productId);

    $('#detail-name').text(result.name + ' - #' + result.id);
    $('#detail-category').text('Category: ' + result.category);
    $('#detail-img').attr('src', '/' + result.thumb);
}

function showConfirm(productId, type = 'copy') {
    if(type === 'copy'){
        $('#confirm-message').text('Bạn có muốn copy sản phẩm #' + productId + ' ?');

        $('#confirm-yes').click(function (e) { 
            e.preventDefault();
            copyRow(productId);
        });
    }else {
        $('#confirm-message').text('Bạn có chắc muốn xóa sản phẩm #' + productId + ' ?');

        $('#confirm-yes').click(function (e) { 
            e.preventDefault();
            deleteRow(productId);
        });
    }
}

function copyRow(productId) {
    let result = products.find(({ id }) => id == productId);

    $.ajax({
        type: "POST",
        url: "/copy",
        data: {name: result.name, categoryId: result.category_id, thumb: result.thumb},
        dataType: "JSON",
        success: function (response) {
            location.reload();
        }
    });
}

function deleteRow(productId) {
    $.ajax({
        type: "POST",
        url: "/delete",
        data: {id: productId},
        dataType: "JSON",
        success: function (response) {
            location.reload();
        }
    });
}

function showFormEdit(productId) {
    let result = products.find(({ id }) => id == productId);
    let option = $('.cate-option');

    for (const element of option) {
        if(element.value == result.category_id) {
            $(element).prop('selected', 'selected');
            break;
        }
    }

    $('#form-title').text('Product update');
    $('#name').val(result.name);
    $('#thumb').val(result.thumb);
    $('#img').attr('src', '/' + result.thumb).removeClass('d-none');
    $('#send').attr('onclick', `sendForm('/update/${productId}')`);
    $('.text-danger').addClass('d-none');
}
