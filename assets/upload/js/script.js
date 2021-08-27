var fileNamesArray = [];

$(function () {

    var ul = $('#upload ul');
    var fileCount = 0;

    $('#drop a, #upload-file-label').click(function () {
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('.upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#message-outlet'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            fileCount++;

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"' +
                ' data-fgColor="#19a708" data-readOnly="1" data-bgColor="#F2F2F2" /><p></p><span id="'+fileCount+'" style="background: url(assets/upload/img/icons.png) no-repeat;"></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo('#file_upload_list');

            $('#group_message_text').addClass('hidden');
            $('#project_message_text').addClass('hidden');

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function () {
                fileCount--;
                var fileNameIndex = $(this).attr('id');
                window.fileNamesArray.splice(fileNameIndex-1, 1);
                // console.log(window.fileNamesArray);
                $("#attachedFiles").val(JSON.stringify(window.fileNamesArray));

                if (tpl.hasClass('working')) {
                    jqXHR.abort();
                }

                tpl.fadeOut(function () {
                    tpl.remove();

                });

                if(!fileCount) {
                    $('#group_message_text').removeClass('hidden');
                    $('#project_message_text').removeClass('hidden');
                    $("#attachedFiles").val('');
                }

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();

        },

        progress: function (e, data) {

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if (progress == 100) {
                data.context.removeClass('working');
            }
        },

        fail: function (e, data) {
            // Something has gone wrong!
            // // console.log(data);
            data.context.addClass('error');
        },

        success: function (e, data) {
            // // console.log(e);
            window.fileNamesArray.push(e.data);
            $("#attachedFiles").val(JSON.stringify(window.fileNamesArray));

        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});