<hr class="col-xs-12">
<div id="cement-create-record">
  <form data-url="{{ url('records/create/sell-cement') }}" id="cement-record-form">
    @csrf
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="customer_name">কাস্টমারের নাম</label>
          <div class="form-group input-group mb-3">
            <input id="customer_name" required type="text" name="customer_name"
            class="@error('customer_name') is-invalid @enderror form-control">
            <div class="input-group-append">
              <button><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>


        <!-- <div class="form-group">
          <label for="customer_name">কাস্টমারের নাম</label>
          <input id="customer_name" required type="text" name="customer_name" class="@error('customer_name') is-invalid @enderror form-control">
          @error('customer_name')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div> -->
      </div>

      <div class="col-sm-4">
        <div class="form-group">
          <label for="brand">ব্র্যান্ড</label>
          <select id="brand" name="brand" class="@error('brand') is-invalid @enderror form-control">
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
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="total_quantity">মোট বস্তা</label>
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

    <div id="customer-information">
    </div>

    <div class="row">
      <div class="col-sm-2">
        <div class="form-group">
            <input type="submit" id="save-cement-record" class="btn btn-primary" value="Save" />
        </div>
      </div>
      <div class="col-sm-6 invisible" id="cement-record-success">
        <div class="alert alert-success" role="alert">
          Record saved successfully!
        </div>
      </div>
    </div>

  </form>
</div>
