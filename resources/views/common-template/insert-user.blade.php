<h3>কাস্টমারের অন্যান্য তথ্য</h3>
<hr class="col-xs-12">
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="mobile">কাস্টমারের মোবাইল নাম্বার</label>
      <input id="mobile"
      type="text"
      name="mobile"
      class="form-control">
    </div>
  </div>

  <div class="col-sm-4">
    <div class="form-group">
      <label for="national_id">কাস্টমারের ন্যাশনাল আইডি</label>
      <input id="national_id"
      type="text"
      name="national_id"
      class="form-control">
    </div>
  </div>

  <div class="col-sm-4">
    <div class="form-group">
      <label for="address">কাস্টমারের ঠিকানা</label>
      <textarea id="address"
      name="address"
      class="@error('address') is-invalid @enderror form-control"></textarea>
      @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="bank_name">ব্যাংকের নাম</label>
      <input id="bank_name"
      type="text"
      name="bank_name"
      class="form-control">
    </div>
  </div>

  <div class="col-sm-4">
    <div class="form-group">
      <label for="bank_account_no">ব্যাংক অ্যাকাউন্ট নাম্বার</label>
      <input id="bank_account_no"
      type="text"
      name="bank_account_no"
      class="form-control">
    </div>
  </div>
</div>
