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
    <li class="active">{{ucfirst($module)}}</li>
</ul>

@endsection

@section('content')
    <x-data-table
        :module="$module"
        id="datatable"
        pshowtools=""
    />

@include($module.'.modal')

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
            {data : null, title : 'Name', render(data){
                return data['name'];
            }},
            {data : null, title : 'Action', render(data,type){
                return '<div class="action-buttons">'+
                            '<a class="blue add-fund" href="#">'+
								'<i class="ace-icon fa fa-money bigger-130"></i>'+
							'</a>'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
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
