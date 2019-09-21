@extends('layouts.app')

@section('content')
<div class="container" id="cement-brands">
    @if(count($records) > 0)
    <table class="table table-striped">
      <thead>
          <tr>
            <td>Name</td>
            <td>Active</td>
          </tr>
      </thead>
      <tbody>
          @foreach($records as $record)
          <tr>
            <td><a href="{{ url('brands', ['id' => $record->id]) }}">{{$record->name}}</a></td>
            <td>
              <input type="checkbox" data-id="{{$record->id}}" class="toggle-enable-disable" name="brand_active" value="{{$record->active}}" @if($record->active === 1) checked @endif />
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    @else
      <p>No records found</p>
    @endif
</div>
@endsection
