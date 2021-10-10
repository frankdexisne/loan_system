<div id="modal-view" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Client Information</h4>
            </div>

            <div class="modal-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a data-toggle="tab" href="#co_maker">
                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                CoMaker
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#beneficiary">
                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                Beneficiary
                            </a>
                        </li>

                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                Others &nbsp;
                                <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-info">
                                <li>
                                    <a data-toggle="tab" href="#savings">Savings</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#withdrawals">Withdrawals</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="co_maker" class="tab-pane fade in active">
                            <form id="form-co-maker">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="client_id" id="client_id">
                                <div class="form-group">
                                    <label for="">Lastname</label>
                                    <input type="text" class="form-control" name="lname" id="co_maker_lname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Firstname</label>
                                    <input type="text" class="form-control" name="fname" id="co_maker_fname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Middlename</label>
                                    <input type="text" class="form-control" name="mname" id="co_maker_mname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select name="gender" id="co_maker_gender" class="form-control">
                                        <option>MALE</option>
                                        <option>FEMALE</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" name="dob" id="co_maker_dob" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_no">Contact Number</label>
                                    <input type="text" name="contact_no" id="co_maker_contact_no" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Position</label>
                                    <input type="text" name="position" class="form-control" id="co_maker_position" required>
                                </div>
                                <div class="form-group">
                                    <label for="Company">Company</label>
                                    <input type="text" name="company" id="co_maker_company" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_salary">Monthly Salary</label>
                                    <input type="text" id="co_maker_monthly_salary" class="form-control" name="monthly_salary" required>
                                </div>
                            </form>
                        </div>

                        <div id="beneficiary" class="tab-pane fade">
                            <form id="form-beneficiary">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="client_id" id="beneficiary_client_id">
                                <div class="form-group">
                                    <label for="">Lastname</label>
                                    <input type="text" class="form-control" name="lname" id="beneficiary_lname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Firstname</label>
                                    <input type="text" class="form-control" name="fname" id="beneficiary_fname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Middlename</label>
                                    <input type="text" class="form-control" name="mname" id="beneficiary_mname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select name="gender" id="beneficiary_gender" class="form-control">
                                        <option>MALE</option>
                                        <option>FEMALE</option>
                                    </select>
                                </div>
                                <x-select
                                    id="beneficiary_relationship_id"
                                    label="Relationship"
                                    :jsondata="$relationships"
                                    name="relationship_id"
                                    optionval="id"
                                    optiontext="name"
                                />
                            </form>
                        </div>

                        <div id="savings" class="tab-pane fade">
                            <table id="datatable-savings" class="table table-striped table-bordered table-hover" style="width:100%">
                            </table>
                        </div>

                        <div id="withdrawals" class="tab-pane fade">
                            <table id="datatable-withdrawals" class="table table-striped table-bordered table-hover" style="width:100%">
                            </table>
                        </div>
                    </div>
                </div>

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
