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
        <a>Loans</a>
    </li>
    <li class="active">Search Client</li>
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
                        href="{{route('loans.create')}}"
                        class="dt-button btn btn-white btn-primary btn-bold"
                        title="Add"
                        >

                        <span>
                            <i class="fa fa-plus bigger-110 blue"></i>
                        </span>
                        &nbsp;
                        CREATE LOAN
                    </a>
                </div>
            </div>
        </div>
        <div class="table-header">
            Query match
        </div>
        <div>
            <form id="search">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="ace-icon fa fa-user"></i>
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
@include($module.'.show')

@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script>
    $(document).ready(function(){
        _element = '#datatable'
        _columns = [
            {data : 'account_no', title : '#'},
            {data : null, title : 'Name', render(data){
                var color = data['gender'] == 'MALE' ? 'blue' : 'pink';
                var gender = data['gender'] == 'MALE' ? 'male' : 'female';
                return '<i class="fa fa-'+gender+' '+color+'"></i> '+data['lname']+', '+data['fname']+' '+data['mname'] + '<br>' +
                        '<i class="fa fa-map green"></i> '+data['full_address'] + '<br>' +
                        '<i class="fa fa-phone"></i> '+data['contact_no'];
            }},
            {data: null, title : 'Job Details', render(data){
                return '<small> Company : ' + data['company'] + '<br>' +
                       'Designation : ' + data['position'] + '<br>' +
                       'Monthly Salary : ' + data['monthly_salary'] + '</small>';
            }},
            {data: 'active_loan', title: 'Active Loan', render(data){
                return '<a href="#" class="active-loan">'+data.length+'</a>';
            }},
            {data : null, title : 'Action', render(data,type){
                return '<div class="action-buttons">'+
                            '<a class="blue show" href="#" title="View">'+
								'<i class="ace-icon fa fa-eye bigger-120"></i>'+
							'</a>'+
							'<a class="green edit" href="#">'+
								'<i class="ace-icon fa fa-pencil bigger-120"></i>'+
							'</a>'+
							'<a class="red delete" href="#">'+
								'<i class="ace-icon fa fa-trash-o bigger-120"></i>'+
							'</a>'+
						'</div>';
            }},
        ];

        _columnDefs = [
            {width: '30%', targets : [1]}
        ]

        $('#search').on('submit', function (e) {
            e.preventDefault();
            _ajax = {
                url: "{{url($module.'/json-data')}}",
                type: "GET",
                data: {
                    name: $(this).find('input[name="name"]').val()
                }
            };
            datatable = initDTable(_element, _ajax, _columns, "{{url('/')}}" , "{{$module}}", null, _columnDefs, false);

            datatable.on('click', '.show', function(e) {
                $tr = $(this).closest('tr');
                var data = datatable.row($tr).data();

                for (const [key, value] of Object.entries(data['co_maker'][0])) {
                    $('#form-co-maker [name="' + key + '"]').val(value);
                }

                for (const [key, value] of Object.entries(data['beneficiary'])) {
                    $('#form-beneficiary [name="' + key + '"]').val(value);
                }


                _ajax = {
                    url: "{{url('payments/json-data')}}",
                    type: "GET",
                    data: {
                        client_id: data['id']
                    }
                };
                _columns = [
                    {data : 'orno', title : '#'},
                    {data: 'payment_date', title : 'Payment date'},
                    {data: 'ps.amount', title : 'Personal Savings'},
                    {data: 'cbu.amount', title : 'Capital Build Up'},
                    {data : null, title : 'Action', render(data,type){
                        return '<div class="action-buttons">'+
                                    '<a class="green edit" href="#">'+
                                        '<i class="ace-icon fa fa-pencil bigger-120"></i>'+
                                    '</a>'+
                                    '<a class="red delete" href="#">'+
                                        '<i class="ace-icon fa fa-trash-o bigger-120"></i>'+
                                    '</a>'+
                                '</div>';
                    }},
                ];
                var datatable_saving = initDTable('#datatable-savings', _ajax, _columns, "{{url('/')}}" , "payments", null, _columnDefs, false);
                $('#modal-view').modal('show');
            })
        })

        _rules = {
            lname: {
                required: true
            },
            fname: {
                required: true
            },
            mname: {
                required: true
            },
            gender: {
                required: true
            },
            job_title_id: {
                required: true
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

        $('#modal-view .submit-form').on('click',function(){
            $tabPane = $('.tab-pane.active');
            if ($tabPane.find('form').length > 0){

                formParams.el = '#'+$tabPane.find('form').attr('id');


                if (formParams.el === '#form-co-maker') {
                    formParams.module = 'co_makers';
                    formParams.rules = {
                        lname: {
                            required: true
                        },
                        fname: {
                            required: true
                        },
                        mname: {
                            required: true
                        },
                        dob: {
                            required: true,
                            date: true
                        },
                        gender: {
                            required: true
                        },
                        contact_no: {
                            required: true
                        },
                        company: {
                            required: true,
                        },
                        position: {
                            required: true
                        },
                        monthly_salary: {
                            required: true,
                            number: true
                        },
                    };
                    formParams.confirm_message = 'Co-maker has been updated';
                } else {
                    formParams.module = 'beneficiaries';
                    formParams.rules = {
                        lname: {
                            required: true
                        },
                        fname: {
                            required: true
                        },
                        mname: {
                            required: true
                        },
                        gender: {
                            required: true
                        },
                        relationship_id: {
                            required: true
                        }
                    };
                    formParams.confirm_message = 'Beneficiary has been updated';
                }

                var id = $(formParams.el).find('input[name="id"]').val();
                formParams.ajax.url = id ? '/'+id : '';
                formParams.ajax.type = 'PUT';
                formParams.callback = () => {
                    $('#modal-form').find('.close').click();
                }

                formValidation();
                $(formParams.el).submit();

                // $tabPane.find('form').submit();
            }
        });



    });
</script>
@endsection
