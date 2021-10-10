<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Payment Form</h4>
            </div>

            <div class="modal-body">
                <form id="form">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">OR #</label>
                        <input type="text" class="form-control" name="orno" id="orno" required>
                    </div>
                    <div class="form-group">
                        <label for="">Payment Date</label>
                        <input type="date" class="form-control" name="payment_date" id="payment_date" required>
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">PS</label>
                        <input type="number" class="form-control" name="ps" id="ps_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">CBU</label>
                        <input type="number" class="form-control" name="cbu" id="cbu_amount" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>

                <button class="btn btn-sm btn-primary submit-form">
                    <i class="ace-icon fa fa-check"></i>
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
