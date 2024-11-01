$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });

  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_like_btn');
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/like/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });

  //投稿の編集モーダル
  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();

    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });


  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});


$(function () {
  //編集ボタン("js-modal-open")が押されたら作動
  $('.js-modal-open').on('click', function () {
    //モーダルの中身("js-modal")の表示
    $('.js-modal').fadeIn();
    //押されたボタンから投稿内容を取得し変数へ格納
    var post = $(this).attr('post');
    //押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するために必要な行為）
    var post_id = $(this).attr('post_id');

    //取得した投稿内容をモーダルの中身へ渡す
    $('.modal_post').text(post);
    //取得した投稿idをモーダルの中身へ渡す
    $('.modal_id').val(post_id);
    return false;


  });

  $(document).on('click', '.btn-primary d-block', function (e) {
    e.preventDefault();
    var post_id = $(this).attr('post_id');

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/bulletin_board/edit/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.update' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });


  //背景部分や閉じるボタン("js-modal-close")が押されたら作動
  $('.js-modal-close').on('click', function () {
    //モーダルの中身("js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});
