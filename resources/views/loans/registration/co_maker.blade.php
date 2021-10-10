<h3>Co-Maker Information</h3>
<div class="form-group">
    <label for="lname">Lastname</label>
    <input type="text" id="co_maker_lname" name="co_maker[lname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="lname">Firstname</label>
    <input type="text" id="co_maker_fname" name="co_maker[fname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="mname">Middlename</label>
    <input type="text" id="co_maker_mname" name="co_maker[mname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" id="co_maker_dob" name="co_maker[dob]" class="form-control" required>
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select name="co_maker[gender]" id="co_maker_gender" class="form-control">
        <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
    </select>
</div>
<div class="form-group">
    <label for="contact_no">Contact #</label>
    <input type="text" class="form-control" name="co_maker[contact_no]" id="co_maker_contact_no">
</div>
<div class="form-group">
    <label for="company">Company</label>
    <input type="text" class="form-control" name="co_maker[company]" id="co_maker_company">
</div>
<div class="form-group">
    <label for="position">Position</label>
    <input type="text" class="form-control" name="co_maker[position]" id="co_maker_position">
</div>
<div class="form-group">
    <label for="monthly_salary">Monthly Salary</label>
    <input type="text" class="form-control" name="co_maker[monthly_salary]" id="co_maker_monthly_salary">
</div>
<div class="form-group">
    <label for="barangay_id">Barangay</label>
    <select name="co_maker_address[philippine_barangay_id]" id="co_maker_address_barangay_id" class="form-control select2">
        @foreach($cities as $city)
            <optgroup label="{{$city->city_municipality_description}}">
                @foreach($city->philippine_barangay as $row)
                    <option value="{{$row->id}}">{{$row['barangay_description']}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="street">Street</label>
    <input type="text" id="co_maker_address_street" class="form-control" name="co_maker_address[street]">
</div>
