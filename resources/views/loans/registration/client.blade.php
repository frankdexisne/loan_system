<h3>Client Information</h3>
<div class="form-group">
    <label for="pn_number">PN Number</label>
    <input type="text" id="client_pn_number" name="client[pn_number]" class="form-control">
</div>
<div class="form-group">
    <label for="lname">Lastname</label>
    <input type="text" id="client_lname" name="client[lname]" class="form-control">
</div>
<div class="form-group">
    <label for="lname">Firstname</label>
    <input type="text" id="client_fname" name="client[fname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="mname">Middlename</label>
    <input type="text" id="client_mname" name="client[mname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" id="client_dob" name="client[dob]" class="form-control" required>
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select name="client[gender]" id="client_gender" class="form-control">
        <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
    </select>
</div>
<div class="form-group">
    <label for="contact_no">Contact #</label>
    <input type="text" class="form-control" name="client[contact_no]" id="client_contact_no">
</div>
<div class="form-group">
    <label for="company">Company</label>
    <input type="text" class="form-control" name="client[company]" id="client_company">
</div>
<div class="form-group">
    <label for="position">Position</label>
    <input type="text" class="form-control" name="client[position]" id="client_position">
</div>
<div class="form-group">
    <label for="monthly_salary">Monthly Salary</label>
    <input type="text" class="form-control" name="client[monthly_salary]" id="client_monthly_salary">
</div>
<div class="form-group">
    <label for="barangay_id">Barangay</label>
    <select name="address[philippine_barangay_id]" id="address_barangay_id" class="form-control select2">
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
    <input type="text" id="address_street" class="form-control" name="address[street]">
</div>

<x-select
    id="client_area_id"
    label="Area"
    :jsondata="$areas"
    name="client[area_id]"
    optionval="id"
    optiontext="name"
/>
