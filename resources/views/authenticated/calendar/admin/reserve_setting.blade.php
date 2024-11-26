@extends('layouts.sidebar')
@section('content')
<div class="w-100  d-flex" style="align-items:center; justify-content:center;">
  <div class="w-100  calendar-plus p-5">
      <div class="p-d">{{ $calendar->getTitle() }}</div>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
