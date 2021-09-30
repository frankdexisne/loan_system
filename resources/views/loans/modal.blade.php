<div id="modal-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Entry Form</h4>
            </div>

            <div class="modal-body">
                <form id="form">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Terms</label>
                        <select name="term_id" id="term_id" class="form-control">
                            @foreach($terms as $row)
                                <option value="{{$row->id}}" data-payment_mode_id = "{{$row->daily_only == 1 ? 1 : 2}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Loan Amount</label>
                        <input type="number" class="form-control" name="loan_amount" id="loan_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">Interest</label>
                        <input type="number" class="form-control" name="interest" id="interest" required>
                    </div>
                    <div class="form-group">
                        <label for="">Date Loan</label>
                        <input type="date" class="form-control" name="date_loan" id="date_loan" required>
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
