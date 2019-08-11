$('#smartwizard').smartWizard({
    selected: 0,
    theme: 'arrows',
    transitionEffect: 'fade',
    showStepURLhash: false,
});
$("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
    if (stepNumber == 0 && stepDirection === 'forward') {
        if (!$("#id_typedocument").val() || !$("#id_document").val() || !$("#id_name").val()) {
            alert("Algunos Campos Son Requerido")
            return false
        }
    }
    return true;
});
$("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
    // Enable finish button only on last step
    if (stepNumber == 3) {
        $('.btn-finish').removeClass('disabled');
    } else {
        $('.btn-finish').addClass('disabled');
    }
});

$('#btn_add_fields').on('click', function () {
    var html = `
    <div class="row" style="align-items: center;">
        <div class="col-12 col-lg-6 col-md-11 col-sm-12">
            <div class="form-group">
                <label for="id_name">Nombre Del Documentos</label>
                <input type="text" class="form-control"
                    id="id_name" name="name_file[]" required autocomplete="off">
            </div>
        </div>
        <div class="col-12 col-lg-5 col-md-11 col-sm-12">
            <div class="form-group">
                <label for="id_document">Subir Documento</label>
                <input type="file" name="file_upload[]" required class="form-control"/>
            </div>
        </div>
        <div class="col-12 col-lg-1 col-md-1 col-sm-12" style="display: flex; justify-content: center;">
            <button type="button" name="btn_delete" class="btn btn-danger" style="margin-top: 15px;">
                <i class="fas fa-trash" name="btn_delete"></i>
            </button>
        </div>
    </div>
    `
    $('#container_form').append(html)
})

$("#container_form").on('click', function (e) {
    var eti = e.target.localName
    var name = ""
    var parent = ""
    if (eti === 'i') {
        name = e.target.getAttribute("name")
        parent = e.target.parentElement.parentElement
    } else {
        name = e.target.name
        parent = e.target.parentElement
    }
    if (name === "btn_delete") {
        parent.parentElement.remove()
        return false
    }
})

$("#id_document").on('blur', function(e){
    var value = $("#id_document").val()
    if (value == "") return false
    $.getJSON(`${base_url}/cartera/api/get-user?document=${value}`)
    .then(function(data) {
        if(!data.status) return false;
        var user = JSON.parse(data.user)
        $("#id_typedocument").val(user.tipo_documento)
        $("#id_document").val(user.documento)
        $("#id_name").val(user.razon_social)
        $("#remove_hidden").removeAttr('hidden')
    })
})