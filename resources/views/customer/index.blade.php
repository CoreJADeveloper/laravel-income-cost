@extends('layouts.app')

@section('content')
<div class="container">

    @if(count($records) > 0)
    <table class="table table-striped">
      <thead>
          <tr>
            <td>নাম</td>
            <td>মোবাইল নাম্বার</td>
            <td>ঠিকানা</td>
            <td>বাকি টাকা</td>
          </tr>
      </thead>
      <tbody>
          @foreach($records as $record)
          <tr>
              <td><a href="{{ url('customers', ['id' => $record->id]) }}">{{$record->name}}</a></td>
              <td>{{$record->mobile}}</td>
              <td>{{$record->address}}</td>
              <td>{{number_format((float)$record->debit, 2, '.', ',')}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="text-xs-center">
      {{ $records->links() }}
    </div>
    @else
      <p>No records found</p>
    @endif
</div>
@endsection
