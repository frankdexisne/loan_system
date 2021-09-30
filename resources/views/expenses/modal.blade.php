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
                        <label for="">Expense Type</label>
                        <select name="expense_type" id="expense_type" class="form-control">
                            @foreach($expense_types as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" class="form-control" name="expense_date" id="expense_date" required>
                    </div>
                    <div class="form-group">
                        <label for="">OR #</label>
                        <input type="text" class="form-control" name="ornos" id="ornos" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" id="description" required>
                    </div>
                    <div class="form-group">
                        <label for="">Value</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            <option>--NO SELECTED--</option>
                            @foreach($employees as $row)
                                <option value="{{$row->id}}">{{$row->full_name}}</option>
                            @endforeach
                        </select>
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
