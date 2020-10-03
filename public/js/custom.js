//
// custom javascript file for the application.
 //

//show image preview on file select/change
function previewImage(input, teg) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+teg).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
