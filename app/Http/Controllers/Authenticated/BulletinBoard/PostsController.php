<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\PostFormRequest;
use Auth;


class PostsController extends Controller
{

     public function show(Request $request){
        $posts = Post::all();
        $categories = MainCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $keyword=$request->keyword;
            $posts = Post::with('user', 'postComments')
            ->where(function($query)use($keyword){
            $query->where('post_title', 'like', '%'.$keyword.'%')
            ->orWhere('post', 'like', '%'.$keyword.'%')->get();
            })
            ->orwhereHas('subCategories',function($query)use($keyword){
                $query->where('sub_category','like','%' .$keyword .'%');
            })->get();
        }else if($request->category_word){
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
}


    public function postDetail($post_id){
        $post = Post::with('user', 'postComments','subCategories')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }




    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);

        //サブカテゴリーを投稿に関連付け
        if($request->post_category_id){
            $post->subCategories()->attach($request->post_category_id);
        }

        return redirect()->route('post.show');
    }

    public function postEdit(PostFormRequest $request){

        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);

        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    public function mainCategoryCreate(Request $request){

         $request->validate([
            'main_category_name' => 'required|max:100|string|unique:main_categories,main_category'
        ]);

        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

        public function subCategoryCreate(Request $request){
             $request->validate([
            'sub_category_name' => 'required|max:100|string|unique:sub_categories,sub_category',
        ]);
        SubCategory::create([
            'sub_category' => $request->sub_category_name,
            'main_category_id' => $request->main_category_id
        ]);
        return redirect()->route('post.input');
    }


    public function commentCreate(Request $request){
          $request->validate([
            'comment' => 'required|max:250|string',
        ]);

        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }


    /*カテゴリー別の投稿表示*/
     public function postCategory($categoryId) {
    $posts = Post::with('user', 'postComments', 'subCategories')
        ->whereHas('subCategories', function($query) use ($categoryId) {
            $query->where('sub_categories.id', $categoryId); // ここを修正
        })->get();

    $category = SubCategory::findOrFail($categoryId);
    $categories = MainCategory::with('subCategories')->get();
    $like = new Like;

    return view('authenticated.bulletinboard.post_category', compact('posts', 'categories', 'category', 'like'));
}

    public function myBulletinBoard(PostFormRequest $request){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(PostFormRequest $request){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
