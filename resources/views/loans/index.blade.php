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
            <div class="pull-left tableTools-container">
                <select name="payment_mode_id" id="payment_mode_id" class="form-control">
                    <option value="0">--PLEASE SELECT ONE--</option>
                    <option value="1">DAILY PAYMENTS</option>
                    <option value="2">WEEKLY PAYMENTS</option>
                </select>
            </div>
            <div class="pull-right tableTools-container">
                <div class="dt-buttons btn-overlap btn-group">
                    <a
                        href="{{route('loans.create')}}"
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
            <form id="search">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="ace-icon fa fa-check"></i>
                    </span>

                    <input type="text" class="form-control search-query" name="name" placeholder="Type your query">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-inverse btn-white">
                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                            Search
                        </button>
                    </span>
                </div>
            </form>

            <table id="datatable" class="table table-striped table-bordered table-hover" style="width:100%">
            </table>
        </div>
    </div>
</div>

@include($module.'.modal')

@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script>
    $(document).ready(function(){


        _element = '#datatable';
        _ajax = {
            url: "{{url($module.'/json-data')}}",
            type: "GET",
            data: {
                status : 'FOR APPROVAL',
                payment_mode_id : $('#payment_mode_id').val(),
            }
        };
        _columns = [
            {data : 'transaction_code', title : '#'},
            {data : 'client', title : 'Name', render(data){
                var color = data['gender'] == 'MALE' ? 'blue' : 'pink';
                return '<i class="fa fa-user '+color+'"></i> '+data['lname']+', '+data['fname']+' '+data['mname'] + '<br>' +
                        '<i class="fa fa-map green"></i> '+data['full_address'] + '<br>' +
                        '<i class="fa fa-phone"></i> '+data['contact_no'];
            }},
            {data: null, title : 'Details', render(data){
                return '<small> Category : ' + data['category']['name'] + '<br>' +
                       'Terms : ' + data['term']['name'] + '<br>' +
                       'Payment Mode : ' + data['payment_mode']['name'] + '</small>';
            }},
            {data : 'loan_amount', title : 'Loan Amount'},
            {data : 'balance', title : 'Balance'},
            {data : null, title : 'Action', render(data,type){
                return '<div class="action-buttons">'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-130"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-130"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        _style = {
            style: 'multi'
        }
        _columnDefs = [
            {width: '30%', targets : [1]}
        ]


        $('#add').click(function(){
            $('#form').find('#id').removeAttr('value');
            $('#form').trigger('reset');
            $('#modal-form').modal('show');
        });

        // var datatable = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}");


        _rules = {
            category_id: {
                required: true
            },
            term_id: {
                required: true
            },
            loan_amount: {
                required: true,
                number: true
            },
            date_loan: {
                required: true,
                date: true
            },
            interest: {
                required: true,
                number: true
            },
        };

        _appends = [
            {payment_mode_id : $('#term_id').find('option:selected').data('payment_mode_id')}
        ];

        function completeCallback(){
            datatable.ajax.reload();
        }

        $('#reload').click(function(){
            datatable.ajax.reload();
        });

        $('#payment_mode_id').change(function(){
            _ajax = {
                url: "{{url($module.'/json-data')}}",
                type: "GET",
                data: {
                    status : 'FOR APPROVAL',
                    payment_mode_id : $('#payment_mode_id').val(),
                    name: $('#search').find('input[name="name"]').val()
                }
            };


            datatable = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}", _style, _columnDefs);
        })

        $('#search').on('submit', function (e) {
            e.preventDefault();
            _ajax = {
                url: "{{url($module.'/json-data')}}",
                type: "GET",
                data: {
                    status : 'FOR APPROVAL',
                    payment_mode_id : $('#payment_mode_id').val(),
                    name: $(this).find('input[name="name"]').val()
                }
            };
            datatable = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}", _style, _columnDefs);
        })




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
