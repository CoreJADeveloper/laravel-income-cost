@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
      <div class="col-sm-6">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div><br />
        @endif
        <form method="POST" action="{{ url('brands/store') }}">
          @csrf

          <div class="form-group">
            <label for="company_name">ব্র্যান্ডের নাম</label>
            <input type="text" name="company_name" class="form-control">
          </div>

          <div class="form-group">
            <label for="company_type">রড / সিমেন্ট ব্র্যান্ড</label>
            <select class="form-control" name="company_type">
              <option value="cement">সিমেন্ট</option>
              <option value="rod">রড</option>
            </select>
          </div>

          <div class="form-group">
            <input type="hidden" name="active" value="1" />
            <input type="submit" class="btn btn-primary" value="Submit" />
          </div>

        </form>
      </div>
    </div>
</div>
@endsection
