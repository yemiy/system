<?php
namespace App\Calendars\General;
use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    $today = Carbon::now()->format('Y-m-d'); // 現在の日付を取得

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        $isPast = $day->everyDay() < $today; // 過去の日付かどうかを判定

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="calendar-td' . ($isPast ? ' past-day' : '') . '">';
           $html[] = $day->render();

           if (in_array($day->everyDay(), $day->authReserveDay())) {
            $reserve = $day->authReserveDate($day->everyDay())->first();
            $reservePart = $reserve->setting_part;
            $reservePartText = ($reservePart == 1) ? "1部" : (($reservePart == 2) ? "2部" : "3部");
            $html[] = '<p class="attendance-complete">' . $reservePartText . ' 参加</p>';
          } else {
            $html[] = '<p class="receipt-ended">受付終了</p>';
          }
          $html[] = '</td>';
        } else {
          $html[] = '<td class="border ' . $day->getClassName() . '">';
          $html[] = $day->render();
          $html[] = '<div class="adjust-area">';

          if(in_array($day->everyDay(), $day->authReserveDay())){
            $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
            if($reservePart == 1){
              $reservePart = "リモ1部";
            } else if($reservePart == 2){
              $reservePart = "リモ2部";
            } else if($reservePart == 3){
              $reservePart = "リモ3部";
            }
            if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
              $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            } else {



                            $reserve = $day->authReserveDate($day->everyDay())->first();
                            $reservePart = $reserve->setting_part;
                            $reservePartText = ($reservePart == 1) ? "1部" : (($reservePart == 2) ? "2部" : "3部");

                            // 削除リンクを表示 (aタグに変更)
                            $html[] = '<a href="#" class="btn btn-danger p-0 w-75 delete-reserve" data-reserve-id="' . $reserve->id . '" data-reserve-part="' . $reservePartText . '" data-reserve-date="' . $day->everyDay() . '" style="font-size:12px" data-toggle="modal" data-target="#cancelModal">' . $reservePartText . '</a>';

              $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';


            }
          } else {
            $html[] = $day->selectPart($day->everyDay());
          }
          $html[] = $day->getDate();
          $html[] = '</td>';
        }
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar/{user_id}" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
