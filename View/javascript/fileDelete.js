/**
 * Created by xunzhao on 6/29/15.
 */
$('body').on('click', '#confirmToDeleteYES', function () {
    $.ajax({
        url: getFileDeleteUrl,
        dataType: 'json',
        data: {filePath: getFileFilePathContainer},
        method: 'POST',
        success: function (data) {

            if (data.success) {
                setAlert('success', 'done', $('#alertMessage'));
            }
            else {

                setAlert('waring', data.message, $('#alertMessage'));

            }

            setTimeout(function(){location.reload();},1500);

        }

    });


});