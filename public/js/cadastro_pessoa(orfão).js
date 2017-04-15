$(document).ready(function(){

    var wrapper = $(".telefones");

    var button = $(".add-field");

    $(button).click(function(e){
        e.preventDefault();
        $(wrapper).append(`
            <div class="" style="margin-top: 10px;">
                <div class="input-group">
                    <input type="text" name="telefone" class="form-control mascara-telefone" required>                    
                    <span class="input-group-addon remove-field" style="cursor: pointer; color:white; background-color: #d9534f; boder-color: #d9534f">
                        <i class="glyphicon glyphicon-remove"></i>
                    </span>
                </div>
           </div>
           `);
    });

    $(wrapper).on("click", ".remove-field", function(e){
        e.preventDefault();
        $(this).parent().remove();
    });

});