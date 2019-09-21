<tr>
  <td>{{Carbon\Carbon::parse($record->created_at)->format('d F Y, h:i A')}}</td>
  @if($record->source == 'cement')
    <td>{{$record->total_quantity}} বস্তা</td>
  @else
    <td>{{$record->total_quantity}} কেজি</td>
  @endif
  <td>{{$record->rate}}</td>
  <td>{{number_format((float)$record->price, 2, '.', ',')}}</td>
  <td>{{number_format((float)$record->total_price, 2, '.', ',')}}</td>
  <td>{{ucfirst($record->commission)}}</td>
  <td>{{number_format((float)$record->credit, 2, '.', ',')}}</td>
  <td>{{number_format((float)$record->debit, 2, '.', ',')}}</td>
</tr>
