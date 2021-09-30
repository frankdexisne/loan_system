@extends('layouts.ace_master')

@section('style')
<style>
.error-provider{
    color: red;
}
.hide-error{
    display:none;
}
</style>
@endsection

@section('content-header')
<ul class="breadcrumb">
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="{{url('/home')}}">Home</a>
    </li>
    <li>
        <a>System Administration</a>
    </li>
    <li class="active">{{ucfirst($module)}}</li>
</ul>

@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- <h3 class="header smaller lighter blue">List of Areas</h3> -->

        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <div class="dt-buttons btn-overlap btn-group">
                    <a
                        id="add"
                        class="dt-button btn btn-white btn-primary btn-bold"
                        title="Add"
                        >
                        <span>
                            <i class="fa fa-plus bigger-110 blue"></i>
                        </span>
                    </a>
                    <a
                        id="reload"
                        class="dt-button btn btn-white btn-success btn-bold"
                        title="Reload"
                        >
                        <span>
                            <i class="fa fa-refresh bigger-110 green"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-header">
            List of {{ucfirst($module)}}
        </div>
        <div>
            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            </table>
        </div>
    </div>
</div>

@include($module.'.modal')
@include($module.'.modal_role')

@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script>
    $(document).ready(function(){


        _element = '#datatable';
        _ajax = {
            url: "{{url($module.'/json-data')}}",
            type: "GET"
        },
        _columns = [
            {data : 'name', title : 'Name'},
            {data : 'email', title : 'Email'},
            {data : null, title : 'Action', render(data,type){
                return '<div class="action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
                            '<a class="orange reset-password" href="#">'+
								'<i class="ace-icon fa fa-undo bigger-130"></i>'+
							'</a>'+
                            '<a class="blue assign-role" href="#" title="Assign Role">'+
								'<i class="ace-icon fa fa-user bigger-130"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        $('#add').click(function(){
            $('#form').find('#id').removeAttr('value');
            $('#form').trigger('reset');
            $('#modal-form').modal('show');
        });

        var datatable = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}");

        datatable.on('click','.reset-password',function(e){
            e.preventDefault();
            $tr=$(this).closest('tr');
            var data = datatable.row($tr).data();
            Swal.fire({
                title: 'Are you sure?',
                text: "Reset user password",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
                })
            .then((result) => {
                if (result.isConfirmed) {
                    var form_data = { _token : $('meta[name="csrf-token"]').attr('content') , id: data['id']};

                    $.ajax({
                        url: "{{url('/'.$module)}}/"+data['id']+"/reset-password",
                        type: "PATCH",
                        data: form_data,
                        success: function(){
                            Swal.fire(
                                'Success!',
                                'Password has been reset',
                                'success'
                            )
                        },
                        error: function(xhr){
                            if(xhr.status==422){
                                Swal.fire(
                                    'Ooops!',
                                    xhr.responseJSON.message,
                                    'error'
                                )
                            }
                        }
                    });
                }
            })
        })

        datatable.on('click','.assign-role',function(e){
            e.preventDefault();
            $tr=$(this).closest('tr');
            var data = datatable.row($tr).data();
            var selectedValues = [];
            $.each(data.roles,function(){
                selectedValues.push(this.id);
            })
            $('select[name="roles"]').val(selectedValues);
            $('input[name="role_id"]').val(data['id']);
            $('#modal-role').modal('show');
        })

        _rules = {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                equalTo: '#password_confirmation'
            },
        };

        _appends = [

        ];

        function completeCallback(){
            datatable.ajax.reload();
        }

        $('#reload').click(function(){
            datatable.ajax.reload();
        });

        $('#modal-form .submit-form').on('click',function(){
            _ajax = {
                url: $('#id').attr('value') ? "{{url('/'.$module)}}/"+$('#id').val() : "{{route($module.'.store')}}",
                type: $('#id').attr('value') ? "PUT" : "POST"
            };
            _baseURL = "{{url('/')}}";
            var form = formValidate('#form',_rules,_appends,_baseURL,"{{$module}}",completeCallback());
            $('#form').submit();
        })

        $('#modal-role .submit-form').click(function(){
            $('#form-role-assignment').submit();
        })

        $('#form-role-assignment').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : "{{url('/users')}}/"+$(this).find('input[name="role_id"]').val()+"/assign-role",
                type: "PATCH",
                data : $(this).serialize(),
                success : function(res){
                    $.gritter.add({
                        title: 'Success',
                        text: 'Role(s) has been set',
                        class_name: 'gritter-success'
                    });
                    $('#form-role-assignment').trigger('reset');
                    $('#modal-role').find('.close').click();
                }
            });
        })





    });
</script>
@endsection
