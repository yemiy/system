$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});

//検索条件選択時の表示閉を防止
document.querySelectorAll('.search_conditions_inner input, .search_conditions_inner select').forEach((element) => {
  element.addEventListener('click', (e) => {
    e.stopPropagation(); // 親要素へのイベント伝播を止める
  });
});
