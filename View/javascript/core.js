/**
 * Created by xunzhao on 6/18/15.
 */

'use strict';
var rootPath = '../ETL_Temp_File_Folder',
    getListUrl = '/Controller/Controller_FolderTree.php',
    getCreateFolderUrl = '/Controller/Controller_CreateNewFolder.php',
    getUploadFileuUrl = '/Controller/Controller_FileUpload.php',
    getFileDeleteUrl = '/Controller/Controller_FileDelete.php',
    getFileFilePathContainer = [],
    temp = [];


function setAlert(alertType, message, element) {
    $('<div data-alert class="alert-box ' + alertType + ' radius">' + message + '<a href="#" class="close">&times;</a></div>').insertBefore(element).fadeIn();
}


//get file download list
function getFileNameDownloadList(array) {
    var html = '';
    for (var i = 0; i < array.length; i++) {
        html += array[i] + '<br>';
    }
    return html;
}


//remove the repeat array
function getRepeatFile(value, array) {
    var newArray = [];
    for (var i = 0; i < array.length; i++) {
        if (value != array[i]) {
            newArray.push(array[i]);
        }
    }
    return newArray;
}


//set the get file list
function getFileList(cont, root) {
    $(cont).addClass('wait');
    $.post(getListUrl, {dir: root}, function (data) {

        var getJSONParsedData = JSON.parse(data);

        //remove the getFolderContainer
        if(temp.length==0){
        $('#defaultPath,#defaultPathForUpload').text(getJSONParsedData.folder[0]);
        $('#drop,#dropUpload').empty();
        for (var i = 0; i < getJSONParsedData.folder.length; i++) {
            temp.push(i);
            $('#drop,#dropUpload').append('<li class="createPathChoosePathStyle">' + getJSONParsedData.folder[i] + '</li>');
        }
        }
        $(cont).find('.start').html('');
        $(cont).removeClass('wait').append(getJSONParsedData.tree);
        if ('ETL_Temp_File_Folder' == root)
            $(cont).find('UL:hidden').show();
        else
            $(cont).find('UL:hidden').slideDown({duration: 100, easing: null});
    });

}


//click the list to distinguish the folder or file
$('#fileContainer').on('click', 'LI SPAN', function () {
    var entry = $(this).parent();
    if (entry.hasClass('folder')) {
        if (entry.hasClass('collapsed')) {
            entry.find('UL').remove();
            getFileList(entry, escape($(this).attr('rel')));
            entry.removeClass('collapsed').addClass('expanded');
        }
        else {
            entry.find('UL').slideUp({duration: 100, easing: null});
            entry.removeClass('expanded').addClass('collapsed');
        }
    }
    return false;
});


//execute the function
$('#fileContainer').html('<ul class="filetree start"><li class="wait">Please wait ...<li></ul>');
getFileList($('#fileContainer'), rootPath);


/**
 * change the default path for creating new folder path
 */
$('body').on('click', '#drop>li', function () {
    $('#defaultPath').text($(this).text());
    $('#drop').removeClass('open');
});


/**
 * change the default path for the upload new file path
 */
$('body').on('click', '#dropUpload>li', function () {
    $('#defaultPathForUpload').text($(this).text());
    $('#dropUpload').removeClass('open');
    setFileUpload();
});

$('body').on('click', '#createNewFolderBtnModal', function () {

    if ($('#inputFolderName').val() == '') {
        setAlert('warning', 'Empty Folder Name', $('#createNewFolderBtnModal'));
        setTimeout(function () {
            $('.alert-box').fadeOut();
        }, 2500);
    }
    else {
        //submit
        $.post(getCreateFolderUrl, {
            rootPath: $('#defaultPath').text(),
            newFolderName: $('#inputFolderName').val()
        }, function (data) {
            var jsonData = JSON.parse(data);

            if (jsonData.success) {
                setAlert('success', jsonData.message, $('#createNewFolderBtnModal'));
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
            else {
                setAlert('warning', jsonData.message, $('#createNewFolderBtnModal'));
            }

        });


    }

});


/**
 * uploading
 */

$('body').on('click', '#uploadBtn', function () {
    setFileUpload();
});




$(document).foundation();
