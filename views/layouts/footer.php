                        
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
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

        // font delete 
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

    </script>


</body>
</html>