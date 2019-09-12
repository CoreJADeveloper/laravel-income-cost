<hr class="col-xs-12">
<div class="row">
  <div class="col-sm-8">
    <div class="list-group">
      <li class="list-group-item"><b>কাস্টমারের নাম</b> {{ $record->name }}</li>
      @if(isset($record->mobile))<li class="list-group-item"><b>কাস্টমারের মোবাইল নাম্বার</b> {{ $record->mobile }}</li>@endif
      @if(isset($record->address))<li class="list-group-item"><b>কাস্টমারের ঠিকানা</b> {{ $record->address }}</li>@endif
      @if(isset($record->national_id))<li class="list-group-item"><b>কাস্টমারের ন্যাশনাল আইডি</b> {{ $record->national_id }}</li>@endif
      @if(isset($record->debit))<li class="list-group-item"><b>মোট বাকি পাওনা</b> {{ $record->debit }} টাকা</li>@endif
    </div>
  </div>
</div>
