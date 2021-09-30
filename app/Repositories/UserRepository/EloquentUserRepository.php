<?php

namespace App\Repositories\UserRepository;

use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::query()->whereBetween('id',[1,5])->orderBy('id','desc')->get();
    }
}