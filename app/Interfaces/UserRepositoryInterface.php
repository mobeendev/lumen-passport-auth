<?php
/**
 * Created by PhpStorm.
 * User: mobee
 * Date: 7/27/2019
 * Time: 2:42 PM
 */
namespace App\Interfaces;

use App\User;

interface UserRepositoryInterface {

    /**
     * Returns user list
     *
     * @return mixed
     */
    public function all();

    /**
     * Get the user by id
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);


}
