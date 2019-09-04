@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div id="section-selection">
      <!-- Group of default radios - option 1 -->
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" value="sell" id="sell-section" name="section-selection">
        <label class="custom-control-label" for="sell-section">বিক্রয়</label>
      </div>

      <!-- Group of default radios - option 2 -->
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" value="buy" id="buy-section" name="section-selection">
        <label class="custom-control-label" for="buy-section">ক্রয়</label>
      </div>

      <!-- Group of default radios - option 3 -->
      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" value="save-cost" id="save-cost" name="section-selection">
        <label class="custom-control-label" for="save-cost">খরচ / জমা</label>
      </div>
    </div>
    <div id="initial-selected-section">
    </div>
  </div>
</div>
@endsection
