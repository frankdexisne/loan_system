@extends('layouts.ace_master')

@section('content-header')
<!-- <div class="nav-search" id="nav-search">
    <form class="form-search">
        <span class="input-icon">
            <input type="date" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" value="{{date('Y-m-d')}}"/>
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </form>
</div>  -->
@endsection

@section('content')

<div class="col-sm-7 infobox-container">
    <div class="infobox infobox-blue">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-users"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">32</span>
            <div class="infobox-content">clients</div>
        </div>

        <!-- <div class="stat stat-success">8%</div> -->
    </div>

    <div class="infobox infobox-orange">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-question"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">11</span>
            <div class="infobox-content">For Approval loans</div>
        </div>

        <!-- <div class="badge badge-success">
            +32%
            <i class="ace-icon fa fa-arrow-up"></i>
        </div> -->
    </div>

    <div class="infobox infobox-green">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-thumbs-up"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">8</span>
            <div class="infobox-content">Approved Loans</div>
        </div>
        <!-- <div class="stat stat-important">4%</div> -->
    </div>

    <div class="infobox infobox-orange">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-send"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">For Release</div>
        </div>
    </div>

    <div class="infobox infobox-green">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-list"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Released</div>
        </div>
    </div>

    <div class="infobox infobox-red">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-calendar"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Overdues</div>
        </div>
    </div>

    <div class="infobox infobox-blue">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-credit-card"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Expenses</div>
        </div>
    </div>

    <div class="infobox infobox-red">
        <div class="infobox-icon">
            <i class="ace-icon fa fa-download"></i>
        </div>

        <div class="infobox-data">
            <span class="infobox-data-number">7</span>
            <div class="infobox-content">Withdrawals</div>
        </div>
    </div>


</div>


@endsection

