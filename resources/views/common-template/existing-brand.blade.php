<hr class="col-xs-12">
<div class="row">
  <div class="col-sm-8">
    <div class="list-group">
      @if(isset($record->debit))
        <li class="list-group-item"><b>মোট বাকি</b> {{ $record->debit }} টাকা</li>
      @else
        <li class="list-group-item">আগের কোন ট্রানজেকশন পাওয়া যায়নি</li>
      @endif
    </div>
  </div>
</div>
