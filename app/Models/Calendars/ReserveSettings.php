<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;

class ReserveSettings extends Model
{
    const UPDATED_AT = null;
    public $timestamps = false;


    // 予約設定テーブルのフィールドに応じてプロパティを定義
    protected $table = 'reserve_settings'; // テーブル名


    protected $fillable = [
        'setting_reserve',
        'setting_part',
        'limit_users',
    ];

    public function users(){
        return $this->belongsToMany('App\Models\Users\User', 'reserve_setting_users', 'reserve_setting_id', 'user_id')->withPivot('reserve_setting_id', 'id');
    }


}
