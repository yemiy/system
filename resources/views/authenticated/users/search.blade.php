@extends('layouts.sidebar')

@section('content')
<div class="search_content  d-flex">

  <div class="reserve_users_area">

    @foreach($users as $user)
    <div class="border one_person"><!--ここからユーザー表示-->
      <div>
        <span class="search-p">ID : </span><span class="search-p2">{{ $user->id }}</span>
      </div>

      <div><span class="search-p">名前 : </span>
      <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="search-p3">{{ $user->over_name }}</span>
          <span class="search-p3">{{ $user->under_name }}</span>
        </a>
      </div>

      <div>
        <span class="search-p">カナ : </span>
        <span class="search-p2">({{ $user->over_name_kana }}</span>
        <span class="search-p2">{{ $user->under_name_kana }})</span>
      </div>

      <div>
        @if($user->sex == 1)
        <span class="search-p">性別 : </span><span class="search-p2">男</span>
        @elseif($user->sex == 2)
        <span class="search-p">性別 : </span><span class="search-p2">女</span>
        @else
        <span class="search-p">性別 : </span><span class="search-p2">その他</span>
        @endif
      </div>

      <div>
        <span class="search-p">生年月日 : </span>
        <span class="search-p2">{{ $user->birth_day }}</span>
      </div>

      <div>
        @if($user->role == 1)
        <span class="search-p">権限 : </span><span class="search-p2">教師(国語)</span>
        @elseif($user->role == 2)
        <span class="search-p">権限 : </span><span class="search-p2">教師(数学)</span>
        @elseif($user->role == 3)
        <span class="search-p">権限 : </span><span class="search-p2">講師(英語)</span>
        @else
        <span class="search-p">権限 : </span><span class="search-p2">生徒</span>
        @endif
      </div>

      <div>
        @if($user->role == 4)
        <span class="search-p">選択科目 :</span>
        @forelse($user->subjects as $subject)
          <span class="search-p2">{{$subject->subject}}</span>
        @empty
        <div><span class="search-p2">選択科目はありません。</span></div>
        @endforelse
        @endif
      </div>

    </div>
    @endforeach
  </div>


  <div class="search_area w-25 ">
    <div class="">
      <p style="font-size: 20px;">検索</p>
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>

      <div>
        <lavel>カテゴリ</lavel><br>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div><br>

      <div>
        <label>並び替え</label><br>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>

     <details class="search_conditions">
     <summary>検索条件の追加</summary>
<!--ここを追加-->

        <div class="search_conditions_inner">

          <div>
            <label>性別</label>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>

          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>

          <div class="selected_engineer">
            <label>選択科目</label>
      <span><input type="checkbox" name="subjects[]" value="1" form="userSearchRequest">国語</span>
      <span><input type="checkbox" name="subjects[]" value="2" form="userSearchRequest">数学</span>
      <span><input type="checkbox" name="subjects[]" value="3" form="userSearchRequest">英語</span>
      </div>

        </div>
      </div>

      <div>
        <input type="reset" value="リセット" form="userSearchRequest">
      </div>

      <div>
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>

    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
     </details>
  </div>
</div>
@endsection
