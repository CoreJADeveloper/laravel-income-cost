@extends('layouts.app')

@section('content')
<div class="container">

    @if(count($records) > 0)
    @include('common-template.customer-information-heading')
    <table class="table table-striped">
      <thead>
          <tr>
            <td>তারিখ</td>
            <td>সিমেন্ট / রড</td>
            <td>মোট পরিমাণ (কেজি / বস্তা)</td>
            <td>দর</td>
            <td>জমা</td>
            <td>মোট দাম</td>
            <td>ক্রেডিট</td>
            <td>ডেভিট</td>
          </tr>
      </thead>
      <tbody>
          @foreach($records as $record)
          @if($record->source != null || $record->source != '')
            @include('common-template.customer-table-initial-row')
          @else
            @include('common-template.customer-table-payment-row')
          @endif
          @endforeach
      </tbody>
    </table>
    <div class="text-xs-center">
      {{ $records->links() }}
    </div>
    @include('common-template.customer-final-record')
    @else
      <p>No records found</p>
    @endif
</div>
@endsection
