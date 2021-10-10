<h3>Beneficiary Information</h3>
<div class="form-group">
    <label for="lname">Lastname</label>
    <input type="text" id="beneficiary_lname" name="beneficiary[lname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="lname">Firstname</label>
    <input type="text" id="beneficiary_fname" name="beneficiary[fname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="mname">Middlename</label>
    <input type="text" id="beneficiary_mname" name="beneficiary[mname]" class="form-control" required>
</div>
<div class="form-group">
    <label for="dob">Date of Birth</label>
    <input type="date" id="beneficiary_dob" name="beneficiary[dob]" class="form-control" required>
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select name="beneficiary[gender]" id="beneficiary_gender" class="form-control">
        <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
    </select>
</div>
<x-select 
    id="beneficiary_relationship_id" 
    label="Relationship"
    :jsondata="$relationships"
    name="beneficiary[relationship_id]"
    optionval="id"
    optiontext="name"
/>
