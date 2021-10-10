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
@include($module.'.for_releasing_modal')

@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script>
    $(document).ready(function(){
        formParams.module = "{{$module}}";

        function initParentTable(){
            dTableParams.el = '#datatable';
            dTableParams.ajax = {
                url: "{{url($module.'/json-data')}}",
                type: "GET",
                data: {
                    status : 'APPROVED',
                    payment_mode_id : $('#payment_mode_id').val(),
                    name: $('#search').find('input[name="name"]').val()
                }
            };
            dTableParams.columns = [
                {data : 'transaction_code', title : '#'},
                {data : 'client', title : 'Name', render(data){
                    var color = data['gender'] == 'MALE' ? 'blue' : 'pink';
                    var gender = data['gender'] == 'MALE' ? 'male' : 'female';
                    return '<i class="fa fa-'+gender+' '+color+'"></i> '+data['lname']+', '+data['fname']+' '+data['mname'] + '<br>' +
                            '<i class="fa fa-map green"></i> '+data['full_address'] + '<br>' +
                            '<i class="fa fa-phone"></i> '+data['contact_no'];
                }},
                {data: null, title : 'Details', render(data){
                    return '<small> Category : ' + data['category']['name'] + '<br>' +
                        'Terms : ' + data['term']['name'] + '<br>' +
                        'Payment Mode : ' + data['payment_mode']['name'] + '</small>';
                }},
                {data : 'loan_amount_formatted', title : 'Loan Amount'},

                {data : null, title : 'Action', render(data,type){
                    return '<div class="action-buttons">'+
                                '<a class="blue for-release" href="#">'+
                                    '<i class="ace-icon fa fa-send bigger-130"></i>'+
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

            dTableParams.style = null
            dTableParams.columnDefs = [
                {width: '30%', targets : [1]}
            ]

            return initDTable1();

        }


        initParentTable();


        $('#add').click(function(){
            $('#form').find('#id').removeAttr('value');
            $('#form').trigger('reset');
            $('#modal-form').modal('show');
        });


        $('#reload').click(function(){

        });

        $('#payment_mode_id').change(function(){
            dTableParams.ajax.data.payment_mode_id = $('#payment_mode_id').val(),
            dTableParams.ajax.data.name = $('#search').find('input[name="name"]').val();
            tableOnChange();
        })

        $('#search').on('submit', function (e) {
            e.preventDefault();
            dTableParams.ajax.data.payment_mode_id = $('#payment_mode_id').val();
            dTableParams.ajax.data.name = $('#search').find('input[name="name"]').val();
            tableOnChange();
        })

        function tableOnChange()
        {
            var datatable = initParentTable();

            datatable.on('click', '.for-release', function(e) {
                $tr = $(this).closest('tr');
                var data = datatable.row($tr).data();
                $('#form-releasing').find('input[name="id"]').val(data['id']);
                dataTableCharge(data);
                $('#modal-for-releasing-form').modal('show');
            })

        }


        function dataTableCharge(_parent)
        {
            _ajaxCharge = {
                url: "{{url('charges/json-data')}}",
                type: "GET",
                data: {
                    loan_id : _parent['id']
                }
            },
            _columnsCharge = [
                {data: null, title: 'Mark', render(data) {
                    var checked = data['loan_charge_id'] !== null ? 'checked' : '';
                    return '<input type="checkbox" value="'+data['id']+'" '+checked+'>'
                }},
                {data : 'name', title : 'Name'},
                {data : null, title : 'Value', render(data) {
                    if (data['loan_charge_id'] !== null) {
                        return '<input type="number" class="amount" value="' + data['amount'] + '">';
                    } else {
                        return data['value'] + (data['is_percent'] === 1 ? '%' : '')
                    }
                }},
            ];

            _columnDefs = [
                {width: '10%', targets : [0]},
                {width: '60%', targets : [1]},
                {width: '30%', targets : [2]}
            ]


            datatableCharge = initDTable("#datatable-charges", _ajaxCharge, _columnsCharge, "{{url('/')}}" , "charges", null, null);

            datatableCharge.on('change','input[type="checkbox"]', function(e) {
                var isCheck = $(this).is(':checked');
                $tr = $(this).closest('tr');
                var dt = datatableCharge.row($tr).data()
                $.ajax({
                    url: "{{url($module.'/commit-charge')}}/"+_parent['id']+"/"+dt['id']+"/"+(isCheck === true ? 'added' : 'removed'),
                    type: "PUT",
                    success: function(res){
                        if (isCheck === true) {
                            var amount = dt['is_percent'] === 1 ? _parent['loan_amount'] * (dt['value']/100) : dt['value'];
                            $tr.find('td').eq(2).html('<input type="number" value="'+amount+'">');
                        } else {
                            $tr.find('td').eq(2).html(dt['value']);
                        }
                    }
                })
            })

            datatableCharge.on('focusout', 'input[type="number"]', function(e) {
                $input = $(this);
                $tr = $input.closest('tr');
                var dt = datatableCharge.row($tr).data();
                dt['amount']= $input.val();
                $.ajax({
                    url: "{{url($module.'/change-charge-amount')}}/"+dt['loan_charge_id'],
                    type: "PATCH",
                    data: {
                        amount: dt['amount']
                    },
                    success: function(res){
                        datatableCharge.row($tr).data(dt).invalidate();
                    }
                })
            })
        }




        $('#modal-form .submit-form').on('click',function () {
            formParams.el = '#form';
            formParams.rules = {
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
            var id = $(formParams.el).find('input[name="id"]').val();
            formParams.ajax.url = id ? '/'+id : '';
            formParams.ajax.type = 'PUT';
            formParams.appends = [
                {payment_mode_id : $('#term_id').find('option:selected').data('payment_mode_id')}
            ];
            formParams.callback = () => {
                $('#modal-form').find('.close').click();
            }
            formValidation();
            $(formParams.el).submit();
        })

        $('#modal-for-releasing-form .submit-form').on('click',function(){
            formParams.el = '#form-releasing';
            formParams.rules = {
                to_release_at: {
                    required: true,
                    date : true
                },
                first_payment: {
                    required: true,
                    date: false
                }
            };
            formParams.appends = [
                'status' => 'APPROVED'
            ];
            formParams.ajax.url = '/move-to-for-release/'+$(formParams.el).find('input[name="id"]').val();
            formParams.ajax.type = 'PATCH';
            formParams.callback = () => {
                $('#modal-for-releasing-form').find('.close').click();
            }
            formValidation();
            $(formParams.el).submit();
        })


    });
</script>
@endsection
