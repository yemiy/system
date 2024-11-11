
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute が未承認です',
    'active_url'           => ':attribute は有効なURLではありません',
    'after'                => ':attribute は :date より後の日付にしてください',
    'after_or_equal'       => ':attribute は :date 以降の日付にしてください',
    'alpha'                => ':attribute は英字のみ有効です',
    'alpha_dash'           => ':attribute は「英字」「数字」「-(ダッシュ)」「_(下線)」のみ有効です',
    'alpha_num'            => ':attribute は「英字」「数字」のみ有効です',
    'array'                => ':attribute は配列タイプのみ有効です',
    'before'               => ':attribute は :date より前の日付にしてください',
    'before_or_equal'      => ':attribute は :date 以前の日付にしてください',
    'between'              => [
        'numeric' => ':attribute は :min ～ :max までの数値まで有効です',
        'file'    => ':attribute は :min ～ :max キロバイトまで有効です',
        'string'  => ':attribute は :min ～ :max 文字まで有効です',
        'array'   => ':attribute は :min ～ :max 個まで有効です',
    ],
    'boolean'              => ':attribute の値は true もしくは false のみ有効です',
    'confirmed'            => ':attribute を確認用と一致させてください',
    'date'                 => ':attribute を有効な日付形式にしてください',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format'          => ':attribute を :format 書式と一致させてください',
    'different'            => ':attribute を :other と違うものにしてください',
    'digits'               => ':attribute は :digits 桁のみ有効です',
    'digits_between'       => ':attribute は :min ～ :max 桁のみ有効です',
    'dimensions'           => ':attribute ルールに合致する画像サイズのみ有効です',
    'distinct'             => ':attribute に重複している値があります',
    'email'                => ':attribute にメールアドレス',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists'               => ':attribute 無効な値です',
    'file'                 => ':attribute アップロード出来ないファイルです',
    'filled'               => ':attribute 値を入力してください',
    'gt'                   => [
        'numeric' => ':attribute は :value より大きい必要があります。',
        'file'    => ':attributeは :value キロバイトより大きい必要があります。',
        'string'  => ':attribute は :value 文字より多い必要があります。',
        'array'   => ':attribute には :value 個より多くの項目が必要です。',
    ],
    'gte'                  => [
        'numeric' => ':attribute は :value 以上である必要があります。',
        'file'    => ':attribute は :value キロバイト以上である必要があります。',
        'string'  => ':attribute は :value 文字以上である必要があります。',
        'array'   => ':attribute には value 個以上の項目が必要です。',
    ],
    'image'                => ':attribute 画像は「jpg」「png」「bmp」「gif」「svg」のみ有効です',
    'in'                   => ':attribute 無効な値です',
    'in_array'             => ':attribute は :other と一致する必要があります',
    'integer'              => ':attribute は整数のみ有効です',
    'ip'                   => ':attribute IPアドレスの書式のみ有効です',
    'ipv4'                 => ':attribute IPアドレス(IPv4)の書式のみ有効です',
    'ipv6'                 => ':attribute IPアドレス(IPv6)の書式のみ有効です',
    'json'                 => ':attribute 正しいJSON文字列のみ有効です',
    'lt'                   => [
        'numeric' => ':attribute は :value 未満である必要があります。',
        'file'    => ':attribute は :value キロバイト未満である必要があります。',
        'string'  => ':attribute は :value 文字未満である必要があります。',
        'array'   => ':attribute は :value 未満の項目を持つ必要があります。',
    ],
    'lte'                  => [
        'numeric' => ':attribute は :value 以下である必要があります。',
        'file'    => ':attribute は :value キロバイト以下である必要があります。',
        'string'  => ':attribute は :value 文字以下である必要があります。',
        'array'   => ':attribute は :value 以上の項目を持つ必要があります。',
    ],
    'max'                  => [
        'numeric' => ':attribute は :max 以下のみ有効です',
        'file'    => ':attribute は :max KB以下のファイルのみ有効です',
        'string'  => ':attribute は :max 文字以下のみ有効です',
        'array'   => ':attribute は :max 個以下のみ有効です',
    ],
    'mimes'                => ':attribute は :values タイプのみ有効です',
    'mimetypes'            => ':attribute は :values タイプのみ有効です',
    'min'                  => [
        'numeric' => ':attribute は :min 以上のみ有効です',
        'file'    => ':attribute は :min KB以上のファイルのみ有効です',
        'string'  => ':attribute は :min 文字以上のみ有効です',
        'array'   => ':attribute は :min 個以上のみ有効です',
    ],
    'not_in'               => ':attribute 無効な値です',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => ':attribute は数字のみ有効です',
    'present'              => ':attribute が存在しません',
    'regex'                => ':attribute 無効な値です',
    'required'             => ':attribute は必須です',
    'required_if'          => ':attribute は :other が :value には必須です',
    'required_unless'      => ':attribute は :other が :values でなければ必須です',
    'required_with'        => ':attribute は :values が入力されている場合は必須です',
    'required_with_all'    => ':attribute は :values が入力されている場合は必須です',
    'required_without'     => ':attribute は :values が入力されていない場合は必須です',
    'required_without_all' => ':attribute は :values が入力されていない場合は必須です',
    'same'                 => ':attribute は :other と同じ場合のみ有効です',
    'size'                 => [
        'numeric' => ':attribute は :size のみ有効です',
        'file'    => ':attribute は :size KBのみ有効です',
        'string'  => ':attribute は :size 文字のみ有効です',
        'array'   => ':attribute は :size 個のみ有効です',
    ],
    'string'               => ':attribute は文字列のみ有効です',
    'timezone'             => ':attribute 正しいタイムゾーンのみ有効です',
    'unique'               => ':attribute は既に存在します',
    'uploaded'             => ':attribute アップロードに失敗しました',
    'url'                  => ':attribute は正しいURL書式のみ有効です',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
      'birth_day.date' => '※生年月日が未入力です',
      'birth_day.after' => '※2000年1月1日から今日まで入力してください',
      'mail_address.required'  => '※メールアドレスは必須です',
      'mail_address.unique'  => '※すでに登録済みのメールアドレスです',
      'mail_address.email'  => '※メール形式で入力してください',
      'mail_address.max'  => '※100文字まで入力してください',
      'over_name.required' => '※性は必須です',
      'under_name.required' => '※名は必須です',
      'over_name.max' => '※10文字まで入力してください',
      'under_name.max' => '※10文字まで入力してください',
      'over_name_kana.required' => '※カタカナは必須です',
      'under_name_kana.required' => '※カタカナは必須です',
      'over_name_kana.regex' => '※カタカナで入力してください',
      'under_name_kana.regex' => '※カタカナで入力してください',
      'password.min' => '※パスワードは8文字以上20文字以内で入力してください',
      'password.max' => '※パスワードは8文字以上20文字以内で入力してください',
      'password.unique' => '※パスワードは現在使われています',
      'password.confirmed' => '※パスワードと確認用と一致させてください',
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
         'main_category_name' => [
        'unique' => 'このカテゴリはすでに存在します。',
        'max'=>'100文字以内で入力してください。',
        'required'=>'入力必須項目です。',
         ],

         'sub_category_name'=>[
            'unique'=>'このカテゴリーはすでに存在します。',
            'max'=>'100文字以内で入力してください。',
            'required'=>'入力必須項目です。',
         ],

         'comment'=>[
            'max'=>'250文字以内で入力してください。',
            'required'=>'入力必須項目です。',
         ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
      'over_name'=> '姓',
      'under_name' => '名',
      'over_name_kana' => 'セイ',
      'under_name_kana' => 'メイ',
      'mail_address' => 'メールアドレス',
      'birth_day' => '生年月日',
      'birth_day_year' => '年',
      'birth_day_month' => '月',
      'birth_day_day' => '日',
      'password' => 'パスワード',
      'password_confirmation' => 'パスワード確認',
      'main category' => 'メインカテゴリー',
      'sub category' => 'メインカテゴリー',
      'main_category' => 'メインカテゴリー',
      'sub_category' => 'メインカテゴリー',
    ],

];
