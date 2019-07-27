<?php
/**
 * Created by PhpStorm.
 * User: mobee
 * Date: 7/27/2019
 * Time: 2:42 PM
 */
namespace App\Repositories;

use App\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    public function all() {
        // return User::all();
    }

    public function find($id) {
        return User::find($id);
    }




}