<div class="row">
  <div class="offset-sm-2 col-sm-8 offset-sm-2">
    <div class="card">
      <div class="card-body text-center">
        <h3>Anowara Trading Corporation</h3>
        <h5>{{$records[0]->name}}</h5>
        <p>{{$records[0]->address}}, Contact: @if(isset($records[0]->mobile)){{$records[0]->mobile}}@endif</p>
        <span>Report For: {{Carbon\Carbon::parse($records[0]->created_at)->format('d F Y')}} - {{Carbon\Carbon::parse($records[count($records) - 1]->created_at)->format('d F Y')}}</span>
        <div>
          <form>
              <input type="button" class="btn btn-success" value="Print"
                     onclick="window.print()" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
