<hr class="col-xs-12">
<div id="customer-due-collection-create-record">
  <form data-url="{{ url('records/create/customer-due-collection') }}" id="customer-due-collection-record-form">
    @csrf
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="customer_name">কাস্টমারের নাম</label>
          <div class="form-group input-group mb-3">
            <input id="customer_name" required type="text" name="customer_name"
            class="@error('customer_name') is-invalid @enderror form-control">
            <div class="input-group-append">
              <button type="button" id="reset-customer-name"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
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
          <label for="amount">জমা</label>
          <input id="amount" required type="number" name="amount" class="@error('amount') is-invalid @enderror form-control">
          @error('amount')
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
          <input type="submit" id="save-customer-due-collection-record" class="btn btn-primary" value="Save" />
        </div>
      </div>
      <div class="col-sm-6 invisible" id="customer-due-collection-record-success">
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

  .required-select-field{
    border-color: #E85F3A;
  }
</style
