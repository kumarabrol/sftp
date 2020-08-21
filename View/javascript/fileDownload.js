/**
 * Created by xunzhao on 6/24/15.
 */
/**
 * download button clicked
 */

function isShowDownloadButton() {

    if (getFileFilePathContainer.length > 0) {
        $('#selected_file').html("File:  <br>" + getFileNameDownloadList(getFileFilePathContainer));
        $('#actionWrap').fadeIn();
    }
    else {
        $('#selected_file').text('');
        $('#actionWrap').css('display', 'none');
    }
}


$('body').on('click', '.fileCheckBoxClass', function () {
    if ($(this).is(':checked')) {
        getFileFilePathContainer.push($(this).parent().find('span').attr('rel'));
        isShowDownloadButton();
    }
    else {
        $(this).prop('checked', false);
        //push the path to container
        getFileFilePathContainer = getRepeatFile($(this).parent().find('span').attr('rel'), getFileFilePathContainer);
        isShowDownloadButton();
    }

    console.log(getFileFilePathContainer);

});

/***
 *click the download button to download files
 */

$('body').on('click', '#downloadButton', function () {

    $.get('/Controller/Controller_FileDownload.php?downloadArray='+JSON.stringify(getFileFilePathContainer), function (data) {
        var getArray = JSON.parse(data);
        for (var i = 0; i < getArray.length; i++) {

            var iframe = $('<iframe style="visibility: collapse;"></iframe>');
            $('body').append(iframe);
            var content = iframe[0].contentDocument;
            var form = '<form action="' + getArray[i].url + '" method="GET"></form>';
            content.write(form);
            $('form', content).submit();
            setTimeout((function (iframe) {
                return function () {
                    iframe.remove();
                }
            })(iframe), 2000);
        }


    });
});