import '@jquery'
import '@bootstrap';
import '@select2';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


$(function() {
    
    $('#ControlSelect2Cities').select2({
        placeholder: "Seleccione las ciudades en las que esta disponible",
        allowClear: true
    });

    $('#ControlSelect2Categories').select2({
        placeholder: "Seleccione las categorias a la que pertenece",
        allowClear: true
    });

    $('#customFile').on('change', function(event) {
        const selectedImage = $('#selectedAvatar');
        const fileInput = event.target;
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                selectedImage.attr('src', e.target.result);
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    });

});
