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
                        <label for="pn_number">PN Number</label>
                        <input type="text" name="pn_number" id="pn_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Lastname</label>
                        <input type="text" class="form-control" name="lname" id="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="fname" id="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Middlename</label>
                        <input type="text" class="form-control" name="mname" id="mname" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option>MALE</option>
                            <option>FEMALE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact Number</label>
                        <input type="text" name="contact_no" id="contact_no" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="">Position</label>
                        <input type="text" name="position" class="form-control" id="position" required>
                    </div>
                    <div class="form-group">
                        <label for="Company">Company</label>
                        <input type="text" name="company" id="company" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="monthly_salary">Monthly Salary</label>
                        <input type="text" id="monthly_salary" class="form-control" name="monthly_salary" required>
                    </div>
                    <div class="form-group">
                        <label for="area_id">Area</label>
                        <x-select
                            id="area_id"
                            label="Area"
                            :jsondata="$areas"
                            name="area_id"
                            optionval="id"
                            optiontext="name"
                        />
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
