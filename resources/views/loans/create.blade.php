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
<div class="row">
    <div class="col-xs-12">

        <div class="table-header">
        </div>
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Create new {{ucfirst($module)}}</h4>

            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div>
                        <form id="form">
                            <input type="hidden" name="id" id="id">
                            @include('loans.registration.client')
                            @include('loans.registration.co_maker')
                            @include('loans.registration.beneficiary')


                            <h3>Loan Detail</h3>
                            <x-select
                                id="loan_category_id"
                                label="Category"
                                :jsondata="$categories"
                                name="loan[category_id]"
                                optionval="id"
                                optiontext="name"
                            />
                            <x-select
                                id="loan_term_id"
                                label="Term"
                                :jsondata="$terms"
                                name="loan[term_id]"
                                optionval="id"
                                optiontext="name"
                            />
                            <div class="form-group">
                                <label for="">Loan Amount</label>
                                <input type="number" class="form-control" name="loan[loan_amount]" id="loan_loan_amount" required>
                            </div>
                            <div class="form-group">
                                <label for="">Interest</label>
                                <input type="number" class="form-control" name="loan[interest]" id="loan_interest" required>
                            </div>
                            <div class="form-group">
                                <label for="">Date Loan</label>
                                <input type="date" class="form-control" name="loan[date_loan]" id="loan_date_loan" required>
                            </div>
                        </form>
                        <div class="clearfix">
                            <button class="btn btn-success submit-form">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- page specific plugin scripts -->
<script>
    $(document).ready(function(){
        $('.select2').select2();
        _rules = {

            'loan.category_id': {
                required: true
            },
            'loan.term_id': {
                required: true
            },
            'loan.loan_amount': {
                required: true,
                number: true
            },
            'loan.date_loan': {
                required: true,
                date: true
            },
            'loan.interest': {
                required: true,
                number: true
            },
        };

        _appends = [
            {payment_mode_id : $('#term_id').find('option:selected').data('payment_mode_id')}
        ];

        function completeCallback(){

        }


        $('.submit-form').on('click',function(e){
            e.preventDefault();
            _ajax = {
                url: $('#id').attr('value') ? "{{url('/'.$module)}}/"+$('#id').val() : "{{route($module.'.store')}}",
                type: $('#id').attr('value') ? "PUT" : "POST"
            };
            _baseURL = "{{url('/')}}";
            var form = formValidate('#form',_rules,_appends,_baseURL,"{{$module}}",completeCallback(),'new-client');
            $('#form').submit();
        })

        // $('#form').on('submit', function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url : "{{url('/loans/new-client')}}",
        //         type: 'POST',
        //         data: $(this).serialize(),
        //         success: function(res){
        //             console.log(res);
        //         }
        //     })
        // })




    });
</script>
@endsection
