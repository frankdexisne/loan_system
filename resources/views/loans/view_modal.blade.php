<div id="modal-view" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">View Details</h4>
            </div>

            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#details" aria-expanded="true">
                                Loan Details
                            </a>
                        </li>

                        <li class="">
                            <a data-toggle="tab" href="#payments" aria-expanded="false">
                                Payments
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div id="details" class="tab-pane fade active in">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Transaction Code </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="transaction_code" placeholder="Transaction code" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Category </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="category_name" placeholder="Category" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Terms </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="term_name" placeholder="Term" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Date Release </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="date_release" placeholder="Date Release" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Payment Duration </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="date_release" placeholder="Date Release" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Last payment date </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="last_payment_date" placeholder="Last payment date" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Balance </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="balance" placeholder="Last payment date" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Settled </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="settled" placeholder="Settled" class="col-xs-12 col-sm-12" readonly style="background:#fff">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="payments" class="tab-pane fade">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">

                <button class="btn btn-sm btn-primary">
                    <i class="ace-icon fa fa-print"></i>
                    Print
                </button>
            </div>
        </div>
    </div>
</div>
