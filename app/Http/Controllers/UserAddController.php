<?php

namespace App\Http\Controllers;

use App\Events\UserAddCreated;
use App\Http\Requests\StoreUserAddRequest;
use App\Http\Requests\UpdateUserAddRequest;
use App\Models\UserAdd;
use Illuminate\Http\Request;

class UserAddController extends Controller
{
    public function store(StoreUserAddRequest $request)
    {

        $userAdd = UserAdd::class::create($request->validated());
        UserAddCreated::dispatch($userAdd);
        return $userAdd;
    }
    public function update(UpdateUserAddRequest $request, UserAdd $userAdd)
    {
        $userAdd->update($request->validated());
        return $userAdd;
    }
}
