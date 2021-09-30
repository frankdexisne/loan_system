<div id="modal-role" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Assign a Role</h4>
            </div>

            <div class="modal-body">
                <form id="form-role-assignment">
                    <input type="hidden" name="role_id">
                    <div class="form-group">
                        <label for="">Role name</label>
                        <select name="roles" id="roles" class="form-control" multiple>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" data-name="{{$role->name}}">{{$role->name}}</option>
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
