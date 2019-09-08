<hr class="col-xs-12">
<div id="cement-create-record">
  <form data-url="{{ url('records/create/sell-cement') }}" id="cement-record-form">
    @csrf
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="customer_name">কাস্টমারের নাম</label>
          <input id="customer_name" type="text" name="customer_name" class="@error('customer_name') is-invalid @enderror form-control">
          @error('customer_name')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="brand">ব্র্যান্ড</label>
          <select name="brand" class="@error('brand') is-invalid @enderror form-control">
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
          <input id="payment_type" type="text" name="payment_type"
          class="@error('payment_type') is-invalid @enderror form-control">
          @error('payment_type')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="total_quantity">মোট বস্তা</label>
          <input id="total_quantity"
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
          <input id="rate"
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
          <input id="price" type="number" name="price" class="@error('price') is-invalid @enderror form-control">
          @error('price')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    <div id="customer-information">
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Save" />
    </div>

  </form>
</div>
