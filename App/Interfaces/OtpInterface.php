<?php

namespace App\Interfaces;

use App\Models\User;

interface OtpInterface {

    public function send(User $user);

    public function verify(string $otp);

    public function update(string $email);


}