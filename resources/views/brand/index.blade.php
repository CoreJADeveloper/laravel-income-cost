@extends('layouts.app')

@section('content')
<div class="container" id="cement-brands">
    @if(count($records) > 0)
    <table class="table table-striped">
      <thead>
          <tr>
            <td>কাস্টমারের নাম</td>
            <td>বাকি টাকা</td>
          </tr>
      </thead>
      <tbody>
          @foreach($records as $record)
          <tr>
            <td><a href="{{ url('brands', ['id' => $record->id]) }}">{{$record->name}}</a></td>
            <td>{{number_format((float)$record->debit, 2, '.', ',')}}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
    @else
      <p>No records found</p>
    @endif
</div>
@endsection
