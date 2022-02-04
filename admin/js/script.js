
document.querySelector(document).ready(function(){
    var $modal = $('#modal');
    var image = document.getElementById('sample_image');
    var cropper;

    document.querySelector('#upload_image').change(function(event){
        var files = event.target.files;
        var done = function(url){
            image.src = url;
            $modal.modal('show');
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(event)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.addEventListener('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview:'.preview'
        });
    }).addEventListener('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    document.querySelector('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:512,
            height:512
        });

        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                data = new FormData();
                data.set('image', base64data);

                httpRequest = new XMLHttpRequest();
                httpRequest.open('POST', 'upload_imagick.php', true);
                httpRequest.send(data);
            };
        });
    });
});