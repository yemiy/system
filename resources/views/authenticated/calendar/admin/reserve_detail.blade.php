@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">

  <div class="w-0 m-auto h-75">

    <p class="y-ti"><span class="ml-3">{{ $date->format('Y年n月j日') }}</span></p>

    <div class=" list-back">
      <table class="fin">
        <tr class="r-top">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>

        @foreach($reservePersons as $reserve)
         @foreach($reserve->users as $user)
        <tr class="r-list ">
          <td class="r-i">{{ $user->id }}</td>
          <td class="r-u">{{ $user->over_name }} {{ $user->under_name}}</td>
          <td class="r-r">リモート</td>
        </tr>
        @endforeach
        @endforeach
      </table>

    </div>
  </div>
</div>
@endsection
