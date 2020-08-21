function setFileUpload() {
    $('#fileupload').fileupload({
        url: getUploadFileuUrl,
        dataType: 'json',
        sequentialUploads: true,
        type: 'post',
        formData: {uploadPath: $('#defaultPathForUpload').text()},
        done: function (e, data) {
            if (data.result.success) {
                console.log(data);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $( ".meter" ).animate({
                width: progress + '%'
            },500 );

            $('#uploadingCompleted').text(progress + '%');
        }
    });
}
