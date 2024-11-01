<?php

namespace App\Policies;

use App\Models\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User as Model ;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function edit(User $user,Model $model)
    {
        //ここで権限のロジックを定義する。（例：管理者のみ編集可能に）
        return $user->is_admin;
    }
}
