@foreach($records as $record)
<li id="{{ $record->value }}">
  <div>
    <p>{{ $record->name }}</p>
    @if(isset($record->mobile))<p>{{ $record->mobile }}</p>@endif
    @if(isset($record->address))<p>{{ $record->address }}</p>@endif
  </div>
</li>
@endforeach
