@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="t-cate">
      <p class="mb-0">カテゴリー</p>
      <select class="w-100" form="postCreate" name="post_category_id[]">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
          @foreach($main_category->subCategories as $sub_category)
          <option value="{{$sub_category->id}}">{{$sub_category->sub_category}}</option>
          @endforeach
        </optgroup>

        <!-- サブカテゴリー表示 -->
        </optgroup>
        @endforeach
      </select>
    </div>
    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post_body'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">{{ csrf_field() }}</form>
  </div>
  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="">
            @if($errors->has('main_category_name'))
            <span class="error_message">{{ $errors->first('main_category_name') }}</span>
        @endif<br>
        <p class="m-0">メインカテゴリー</p>
        <form action="{{ route('main.category.create')}}" method="post" id="mainCategoryRequest">
          @csrf

        <input type="text" class="m-c-name" name="main_category_name" >
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" >
        </form>
      </div><br>

      <!-- サブカテゴリー追加 -->
       <div>
            @if($errors->has('sub_category_name'))
            <span class="error_message">{{ $errors->first('sub_category_name') }}</span>
        @endif<br>
        <label >サブカテゴリ―</label>
        <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">
        @csrf

           <select class="w-100" name="main_category_id">
            @foreach($main_categories as $main_category)
            <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
            @endforeach
          </select><br><br>


      <input type="text" class="m-c-name" name="sub_category_name" >
      <input type="submit" value="追加" class="w-100 btn btn-primary" >
</form>
      </div>

    </div>
  </div>
  @endcan
</div>
@endsection
