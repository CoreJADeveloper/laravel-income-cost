<hr class="col-xs-12">
<div class="row">
  <div class="col-sm-12 final-record-card">
    <div class="card">
      <div class="card-body text-right">
        <p>মোট বাকি {{number_format((float)$records[count($records) - 1]->debit, 2, '.', ',')}} টাকা</p>
      </div>
    </div>
  </div>
</div>
