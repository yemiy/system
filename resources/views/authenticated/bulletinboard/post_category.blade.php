@extends('layouts.sidebar')
@section('content')

<div class="post_view w-75 mt-5">
    <h1 class="w-75 m-auto"><!--{{ $category->main_category }} の-->投稿一覧</h1>

    @if($posts->isEmpty())
        <p class="w-75 m-auto">このカテゴリーには投稿がありません。</p>
    @else
        @foreach($posts as $post)
            <div class="post_box  w-75 m-auto p-3">
                <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
                <p><a href="{{ route('post.category', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>

                <div class="post_bottom_area d-flex">
                    <div class="sub-cate2">
                        @foreach($post->subCategories as $category)
                            <li>{{ $category->sub_category }}</li>
                        @endforeach
                    </div>

                    <div class="d-flex post_status">
                        <div class="mr-5">
                            <i class="fa fa-comment"></i><span class="">{{ $post->postComments->count() }}</span>
                        </div>

                        <div class="like-come">
                            @if(Auth::user()->is_Like($post->id))
                                <p class="m-0">
                                    <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                                    <span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span>
                                </p>
                            @else
                                <p class="m-0">
                                    <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i>
                                    <span class="like_counts{{ $post->id }}"></span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div> <!-- post_bottom_area -->
            </div> <!-- post_area -->
        @endforeach
    @endif
</div> <!-- post_view -->

<div class="other_area">
    <div class=" m-4">
        <div class="c-po">
            <a href="{{ route('post.input') }}">投稿</a>
        </div>
        <div class="keyword">
            <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest" class="k-box">
            <input type="submit" value="検索" form="postSearchRequest" class="key-b">
        </div>

        <input type="submit" name="like_posts" class="category_btn-1" value="いいねした投稿" form="postSearchRequest">
        <input type="submit" name="my_posts" class="category_btn-2" value="自分の投稿" form="postSearchRequest">

         <ul class="search_conditions">
    <p style="padding-top:20px">カテゴリー検索</p>

            @foreach($categories as $mainCategory)
                <summary class="main_category" category_id="{{ $mainCategory->id }}">
                    <a href="{{ route('post.category', ['id' => $mainCategory->id]) }}">{{ $mainCategory->main_category }}</a>
                </summary>
                @if($mainCategory->subCategories->isNotEmpty())
                    <div class="search_conditions_inner">
                        @foreach($mainCategory->subCategories as $subCategory)

                            <li>
                                <a href="{{ route('post.category', ['id' => $subCategory->id]) }}">{{ $subCategory->sub_category }}</a>
                            </li>
                        @endforeach
</div>
                @endif
            @endforeach
        </ul>
    </div>
</div> <!-- other_area -->

<form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>

@endsection
