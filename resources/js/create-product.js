$(document).ready(function() {
    $('#image').change(function () {
        let input = this;
        let imgPreview = $('#image-preview')[0];
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                imgPreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            imgPreview.src = '';
        }
    });


    $('#file-upload').change(function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
});
