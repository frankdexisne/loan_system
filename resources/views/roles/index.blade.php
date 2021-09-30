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
@include($module.'.modal_permissions')

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
            {data : null, title : 'Action', render(data,type){
                return '<div class="action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
                            '<a class="orange set-permissions" href="#">'+
								'<i class="ace-icon fa fa-list bigger-130"></i>'+
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

        datatable.on('click','.set-permissions',function(e){
            e.preventDefault();
            $tr=$(this).closest('tr');
            var data = datatable.row($tr).data();
            initTablePermissions(data['id']);
            $('#modal-permissions').modal('show');
        });



        function initTablePermissions(id){
        _element = '#table-permissions';
        _ajax = {
            url: "{{url($module)}}/"+id+"/get-permissions",
            type: "GET"
        },
        _columns = [
            {data: 'has_permission', render(data,type){
                var isChecked = data == 1 ? 'checked' : '';
                return '<input type="checkbox" class="grant-permission" '+isChecked+'>';
            }},
            {data : 'display_name', title : 'Name'},
        ];

        var tablePermission = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}");
        tablePermission.on('change','.grant-permission',function(e){
            $granted = $(this).is(':checked');
            $tr = $(this).closest('tr');
            var data = tablePermission.row($tr).data();
            e.preventDefault();
            $.ajax({
                url: "{{url('/roles')}}/"+id+"/assign-permissions",
                type: "PATCH",
                data: {
                    granted : $granted,
                    name: data['name']
                }
            })
        })
        }

        _rules = {
            name: {
                required: true
            }
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

    });
</script>
@endsection
