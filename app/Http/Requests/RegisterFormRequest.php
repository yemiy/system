<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //[ *1.変更：default=false ]
    }

    public function getValidatorInstance()
    {
      $old_year = $this->input('old_year');
      $old_month = $this->input('old_month');
      $old_day = $this->input('old_day');
      // 日付を作成(ex. 2020-1-20)
      $birth_day = $old_year . '-' . $old_month . '-' . $old_day;
      // rules()に渡す値を追加でセット
      //     これで、この場で作った変数にもバリデーションを設定できるようになる

      $this->merge([
        'birth_day' => $birth_day,
      ]);
      return parent::getValidatorInstance();
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          //[ *2.追加：Validationルール記述箇所 ]
          'over_name' => ['required','max:10','string'],
          'under_name' => ['required','max:10','string'],
          'over_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
          'under_name_kana' => ['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
          'mail_address' => ['required','email:filter','max:100','unique:users'],
          'sex' => ['required','in: 1,2,3'],
          'birth_day' => ['required','before:yesterday','after:1999-12-31'],
          'role' => ['required','in: 1,2,3,4'],
          'password' => ['required','min:8','max:20','confirmed','unique:users'],
          'password_confirmation' => ['required','min:8','max:20']
        ];
    }

    //[ *3.追加：Validationメッセージを設定（省略可） ]
    //function名は必ず「messages」となる。
    public function massages(){
      return[
        //
        'over_name.required' => '※性は必須です',
        'under_name.required' => '※名は必須です',
        'over_name.max' => '※10文字まで入力してください',
        'under_name.max' => '※10文字まで入力してください',
        'over_name_kana.required' => '※カタカナは必須です',
        'under_name_kana.required' => '※カタカナは必須です',
        'over_name_kana.regex' => '※カタカナで入力してください',
        'under_name_kana.regex' => '※カタカナで入力してください',
        'mail_address.required'  => '※メールアドレスは必須です',
        'mail_address.email'  => '※メール形式で入力してください',
        'mail_address.unique'  => '※すでに登録済みのメールアドレスです',
        'mail_address.max'  => '※100文字まで入力してください',
        'birth_day.required' => '※生年月日が未入力です',
        'birth_day.yesterday' => '※2000年1月1日から今日まで入力してください',
        'birth_day.before' => '※2000年1月1日から今日まで入力してください',
        'password.unique' => '※パスワードは現在使われています',
        'password.confirmed' => '※パスワードと確認用と一致させてください',
        'password.min' => '※パスワードは8文字以上20文字以内で入力してください',
        'password.max' => '※パスワードは8文字以上20文字以内で入力してください',
        'password.required' => '※パスワードは必須です',
      ];
    }
}
