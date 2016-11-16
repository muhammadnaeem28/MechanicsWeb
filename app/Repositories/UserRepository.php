<?php
/**
 * Created by PhpStorm.
 * User: Muhammad
 * Date: 12/4/2015
 * Time: 3:26 AM
 */



namespace App\Repositories;
use App\User;
class UserRepository {
    /**
     * @param $userData
     * @return static
     */
    public static function findByUsernameOrCreate($id,$fname,$lname,$email,$picture)
    {

        return User::firstOrCreate([

            'fb_id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'image_url' => $picture



        ]);

    }
}