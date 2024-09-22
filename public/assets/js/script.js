function navigate(url) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('app').innerHTML = data; 
        })
        .catch(error => console.error('Error fetching page:', error));
}
// toast config..
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


// font 
$(document).on('change','#dropzone-file',function(){
    var fileName = $(this).val().split('\\').pop(); 
    $('#file-name').text(fileName); 
})
$(document).on('submit','#font-upload-form',function(e){
    e.preventDefault(); 

    var formData = new FormData(this); 

    $.ajax({
        url: '/font/upload', 
        type: 'POST',
        data: formData,
        processData: false, 
        contentType: false, 
        success: function(response) {
            $('#response-message').html('<p class="text-green-500">' + response.message + '</p>');
            $('#font-upload-form')[0].reset();
            $('#file-name').text('Click to upload'); 
            navigate('/');
        },
        error: function(xhr, status, error) {
            $('#response-message').html('<p class="text-red-500">Error: ' + xhr.responseJSON['message'] + '</p>');
        }
    });
});
$(document).on('click', '.delete-font', function(e) {
    e.preventDefault();
    var fontId = $(this).data('id');

    if (confirm('Are you sure you want to delete this font?')) {
        $.ajax({
            url: '/font/delete', // Include fontId in the URL
            type: 'POST',
            data:{id:fontId},
            success: function(response) {
                navigate('/')
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});


// delete_font_group
$(document).on('click','#add-row',function(){
    let item = $('#copy_item').html();
    $('#main_item').append(item)
})
$(document).on('click', '.remove_item', function(){
    $(this).parent('div').remove();
});
$(document).on('submit', '#group_form', function(e) {
    e.preventDefault();

    var formData = $(this).serializeArray();

    $.ajax({
        url: '/font/group/store',
        method: 'POST',
        data: formData,
        success: function(response) {
            toastr.success(response.message)
            navigate('/font/group');
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            Object.values(errors).map((item,key)=>{
                toastr.error(item)
            });
        }
    });
});

$(document).on('submit', '#group_form_up', function(e) {
    e.preventDefault();

    var formData = $(this).serializeArray();

    $.ajax({
        url: '/font/group/update',
        method: 'POST',
        data: formData,
        success: function(response) {
            toastr.success(response.message)
            navigate('/font/group');
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            Object.values(errors).map((item,key)=>{
                toastr.error(item)
            });
        }
    });
});

$(document).on('click', '.delete_font_group', function(e) {
    e.preventDefault();
    var fontId = $(this).data('id');
    if (confirm('Are you sure you want to delete this font group?')) {
        $.ajax({
            url: '/font/group/delete',
            type: 'POST',
            data:{id:fontId},
            success: function(response) {
                toastr.success(response.message)
                navigate('/font/group')
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});