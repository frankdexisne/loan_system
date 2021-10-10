<div id="modal-for-collection" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Generate For-Collection</h4>
            </div>

            <div class="modal-body">
                <form id="form-for-collection">
                    <input type="hidden" name="id" id="id">

                    <x-select
                        id="area_id"
                        label="Area"
                        :jsondata="$areas"
                        name="area_id"
                        optionval="id"
                        optiontext="display_name"
                    />

                    <div class="form-group">
                        <label for="">As of</label>
                        <input type="date" class="form-control" name="schedule_date" id="schedule_date" max="{{date('Y-m-d')}}" required>
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
                    Generate
                </button>
            </div>
        </div>
    </div>
</div>
