<tr>
  <td>{{Carbon\Carbon::parse($record->created_at)->format('d F Y, h:i A')}}</td>
  <td colspan="5" class="text-center">{{$record->payment_type}}</td>
  <td>{{number_format((float)$record->credit, 2, '.', ',')}}</td>
  <td>{{number_format((float)$record->debit, 2, '.', ',')}}</td>
</tr>
