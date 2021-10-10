
this.formParams = {
    module: '',
    el: '',
    rules: [],
    appends: [],
    ajax: {
        url: '',
        type : ''
    },
    confirm_message: '',
    callback: () => {}
};

function formValidation(){

    return $(formParams.el).validate({
        rules: formParams.rules,
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
        submitHandler: function () {
            let appendData = '';
            $(formParams.el+' .submit-form').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i><span class="bigger-110"><font size="1">Please wait..</font></span>');
            $(formParams.el+' .submit-form').attr('disabled',true);
            // APPENDS HAPPEN HERE
            for (const [key, value] of Object.entries(formParams.appends)) {
                appendData += key+'='+value;
            }

            $.ajax({
                url: origin+'/'+formParams.module+formParams.ajax.url,
                type: formParams.ajax.type,
                data: $(formParams.el).serialize(),
                processData: false,
                success: function(result){
                    formParams.callback()
                    $.gritter.add({
                        title: 'Success',
                        text: formParams.confirm_message,
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





