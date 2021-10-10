function formValidate(
    $el,
    _rules,
    _appends = [],
    _baseURL,
    _module,
    _callback,
    _subURI = ''
){
    return $($el).validate({
        rules: _rules,
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            // let formData = new FormData(form);
            let appendData = '';
            $($el+' .submit-form').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i><span class="bigger-110"><font size="1">Please wait..</font></span>');
            $($el+' .submit-form').attr('disabled',true);
            // APPENDS HAPPEN HERE
            for (const [key, value] of Object.entries(_appends)) {
                appendData += key+'='+value;
            }

            $.ajax({
                url: $('#id').attr('value') ? _baseURL+"/"+_module+"/"+$('#id').val() : _baseURL+"/"+_module+(_subURI !=='' ? '/'+_subURI : ''),
                type: $('#id').attr('value') ? "PUT" : "POST",
                data: $($el).serialize(),
                processData: false,
                success: function(result){
                    _callback
                    $.gritter.add({
                        title: 'Success',
                        text: $('#id').attr('value') ? 'Data is successfully updated' : 'New data has been added',
                        class_name: 'gritter-success'
                    });
                },
                error: function(xhr){
                    if(xhr.status==422){
                        var responseJSON = xhr.responseJSON;
                        var jsonData = responseJSON.errors;
                        var textContent = '';
                        Object.keys(jsonData).forEach(function(key) {
                            var value = jsonData[key][0];
                            textContent += '<br>'+value;
                        });

                        $.gritter.add({
                            title: responseJSON.message,
                            text: textContent,
                            class_name: 'gritter-error'
                        });
                    }else{

                    }
                }
            })
        }
    });
}


