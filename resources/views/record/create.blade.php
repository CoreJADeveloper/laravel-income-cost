@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div id="section-selection">
        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" value="sell" id="sell-input" name="section-selection">
          <label class="custom-control-label" for="sell-input">বিক্রয়</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" value="buy" id="buy-input" name="section-selection">
          <label class="custom-control-label" for="buy-input">ক্রয়</label>
        </div>

        <div class="custom-control custom-radio">
          <input type="radio" class="custom-control-input" value="save-cost" id="save-cost-input" name="section-selection">
          <label class="custom-control-label" for="save-cost-input">খরচ / জমা</label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div id="initial-selected-section">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div id="selected-section-container">
      </div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="col-sm-12">

    </div>
  </div> -->
</div>
@endsection
