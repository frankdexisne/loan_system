<div id="modal-for-releasing-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">{{$title ?? 'For Releasing'}} Form</h4>
            </div>

            <div class="modal-body">
                <form id="form-releasing">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">{{$label ?? 'To release at'}}</label>
                        <input type="date" class="form-control" name="{{$name ?? 'to_release_at'}}" id="{{$name ?? 'to_release_at'}}" required>
                    </div>
                    <div class="form-group">
                        <label for="">First Payment</label>
                        <input type="date" class="form-control" name="first_payment" id="first_payment" required>
                    </div>
                </form>

                <table id="datatable-charges" class="table table-striped table-bordered table-hover" style="width:100%">
                </table>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>

                <button class="btn btn-sm btn-primary submit-form">
                    <i class="ace-icon fa fa-check"></i>
                    Proceed
                </button>
            </div>
        </div>
    </div>
</div>
