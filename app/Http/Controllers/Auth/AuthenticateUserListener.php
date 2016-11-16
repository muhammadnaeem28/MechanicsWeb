<?php

namespace App\Http\Controllers\Auth;

interface AuthenticateUserListener {
    /**
     * @param $user
     * @return mixed
     */
    public function userHasLoggedIn($user);
}