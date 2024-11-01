<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }
   public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }


public function delete(Request $request){
    DB::beginTransaction();
    try {
        // 予約IDを取得
        $reserveId = $request->input('reserve_id');

        // 対応する予約設定を取得
        $reserveSetting = ReserveSettings::find($reserveId);

        // 予約設定が見つからない場合のエラーハンドリング
        if (!$reserveSetting) {
            return redirect()->back()->withErrors('指定された予約は存在しません。');
        }

        // 予約枠を1つ増やす
        $reserveSetting->increment('limit_users');

        // ユーザーの予約を削除する
        $reserveSetting->users()->detach(Auth::id());

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // エラーハンドリング
        return redirect()->back()->withErrors('キャンセル処理中にエラーが発生しました。');
    }

    // キャンセル完了後に最初のページ（calendar.general.show）へリダイレクト
    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
}

}
