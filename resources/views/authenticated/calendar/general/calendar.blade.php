@extends('layouts.sidebar')
@section('content')

<!-- jQueryを読み込む -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- BootstrapのJavaScriptとCSSを読み込む -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 h-auto m-auto pt-5 pb-5" style="border-radius:8px; background:#FFF;">
    <div class="w-75 m-auto" style="border-radius:5px;">
      <p class="text-center" style="font-size:18px;">{{ $calendar->getTitle() }}</p><!--年月を表示-->
      <div class="">
        {!! $calendar->render() !!} <!--カレンダーを表示-->
      </div>
    </div>
    <div class="reserve-b">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>



    <!-- キャンセル確認モーダル
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <input type="hidden" name="deleteParts" id="reserveSettingId" value="">
                </div>
                <div class="modal-footer d-flex justify-content-between w-100">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-danger" id="confirmCancel">キャンセル</button>
                </div>
            </div>
        </div>
    </div>

</div>
 -->
<!-- キャンセル確認モーダル -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">予約キャンセルの確認</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>以下の予約をキャンセルしますか？</p>
        <p><strong>予約日:</strong> <span id="modal-reserve-date"></span></p>
        <p><strong>部:</strong> <span id="modal-reserve-part"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <form id="deleteForm" method="post" action="/delete/calendar">
          {{ csrf_field() }}
          <input type="hidden" name="reserve_id" id="modal-reserve-id" value="">
          <button type="submit" class="btn btn-danger">キャンセルする</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-reserve').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const reserveId = this.getAttribute('data-reserve-id');
            const reserveDate = this.getAttribute('data-reserve-date');
            const reservePart = this.getAttribute('data-reserve-part');

            document.getElementById('modal-reserve-id').value = reserveId;
            document.getElementById('modal-reserve-date').textContent = reserveDate;
            document.getElementById('modal-reserve-part').textContent = reservePart;

            // モーダルを表示
            $('#cancelModal').modal('show');
        });
    });

  document.getElementById('cancelButton').addEventListener('click', function () {
    $('#cancelModal').modal('hide'); // モーダルを閉じる
  });

    // フォーム送信後に処理を行う
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // キャンセルが成功した場合、モーダルを閉じてページをリロード
                $('#cancelModal').modal('hide'); // モーダルを閉じる

                // モーダルが閉じた後にページをリロード
                setTimeout(function() {
                    window.location.href = "{{ route('calendar.general.show', ['user_id' => Auth::id()]) }}";
                }, 500); // モーダルが閉じる時間のために少し遅延を追加
            } else {
                console.error('Cancellation failed:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>


@endsection
