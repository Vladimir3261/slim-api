<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 5/30/18
 * Time: 10:22 PM
 */

namespace Application\Base;


use Application\Models\User;

class Authentication
{
    private static $id;

    /**
     * @param string $token
     * @throws UnauthorizedException
     * @return mixed
     */
    public function auth($token)
    {
        if (!$token) {
            throw new UnauthorizedException();
        }

        $user = User::where(['token' => $token])->first();

        if (!$user) {
            throw new UnauthorizedException();
        }

        self::$id = $user->id;

        return self::$id;
    }

    public static function user()
    {
        return User::find(['id' => self::$id])->first();
    }
}