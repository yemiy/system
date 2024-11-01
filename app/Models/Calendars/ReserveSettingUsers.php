<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class ReserveSettingUsers extends Model {
    protected $table = 'reserve_setting_users'; // テーブル名
    protected $primaryKey = 'user_id'; // 主キー名
    public $timestamps = true; // タイムスタンプの管理
    protected $fillable = ['user_id', 'setting_reserve', 'reserve_date']; // 一括割り当て可能なカラム

    // リレーションの定義
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reserveSetting() {
        return $this->belongsTo(ReserveSettings::class, 'setting_reserve');
    }

    // カスタムメソッドの例
    public function getReservedCount() {
        return self::where('setting_reserve', $this->setting_reserve)->count();
    }

}
