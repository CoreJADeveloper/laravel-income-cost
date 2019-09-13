<hr class="col-xs-12">
<div id="rod-buy-create-record">
  <form data-url="{{ url('records/create/buy-rod') }}" id="rod-buy-record-form">
    @csrf
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="brand">ব্র্যান্ড</label>
          <select id="brand" name="brand" class="@error('brand') is-invalid @enderror form-control">
            <option value="0">-- নিচের যে কোন একটি ব্র্যান্ড সিলেক্ট করূন --</option>
            @foreach($records as $record)
              <option value="{{$record->id}}">{{$record->name}}</option>
            @endforeach
          </select>
          @error('brand')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="payment_type">পেমেন্ট টাইপ</label>
          <input id="payment_type" required type="text" name="payment_type"
          class="@error('payment_type') is-invalid @enderror form-control">
          @error('payment_type')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="due_no">ডিও নাম্বার</label>
          <input id="due_no" required type="text" name="due_no"
          class="@error('due_no') is-invalid @enderror form-control">
          @error('due_no')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="total_quantity">মোট পরিমাণ / কেজি</label>
          <input id="total_quantity" required
          type="number"
          name="total_quantity"
          class="@error('total_quantity') is-invalid @enderror form-control">
          @error('total_quantity')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="rate">দর</label>
          <input id="rate" required
          type="number"
          name="rate"
          class="@error('rate') is-invalid @enderror form-control">
          @error('rate')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="price">জমা</label>
          <input id="price" required type="number" name="price" class="@error('price') is-invalid @enderror form-control">
          @error('price')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="commission">কমিশন</label>
          <input id="commission" required
          type="number"
          value="0"
          name="commission"
          class="@error('commission') is-invalid @enderror form-control">
          @error('commission')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div id="customer-information">
    </div>

    <hr class="col-xs-12">

    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
          <input type="hidden" id="current-user-id" name="current_user_id" value="" />
          <input type="submit" id="save-rod-buy-record" class="btn btn-primary" value="Save" />
        </div>
      </div>
      <div class="col-sm-6 invisible" id="rod-buy-record-success">
        <div class="alert alert-success" role="alert">
          Record saved successfully!
        </div>
      </div>
    </div>

  </form>
</div>

<style>
  .autocomplete-customer-container{
    padding: 5px;
  }

  .autocomplete-customer-card{
    border-radius: 0;
  }

  .ui-autocomplete {
    overflow-x: hidden;
    overflow-y: auto;
    max-height: 350px;
  }

  .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
    background: #56BF8D !important;
    font-weight: bold !important;
    border: none;
    color: #ffffff !important;
  }
</style
