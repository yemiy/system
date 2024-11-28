@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="calendar-plus w-100">
    <p class="p-d">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
