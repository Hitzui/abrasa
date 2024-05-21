function upload(){
    var file_id = e.target.id;

    var file_name_arr = [];
    var process_path = site_url + '/public/uploads/';
    var fileId = $("#" + file_id);
    for (i = 0; i < fileId.prop("files").length; i++) {

        var form_data = new FormData();
        var file_data = fileId.prop("files")[i];
        form_data.append("file_name", file_data);

        if (check_multifile_logo(fileId.prop("files")[i]['name'])) {
            $.ajax({
                //url         :   site_url + "inc/upload_image.php?width=96&height=60&show_small=1",
                url: site_url + "inc/upload_contact_info.php",
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                data: form_data,
                type: 'post',
                success: function(data) {
                    // display image
                }
            });
        } else {
            $("#" + html_div).html('');
            alert('We only accept JPG, JPEG, PNG, GIF and BMP files');
        }

    }
}
function check_multifile_logo(file) {
    var extension = file.substr((file.lastIndexOf('.') + 1))
    if (extension === 'jpg' || extension === 'jpeg' || extension === 'gif' || extension === 'png' || extension === 'bmp') {
        return true;
    } else {
        return false;
    }
}