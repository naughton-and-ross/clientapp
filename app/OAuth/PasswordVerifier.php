<?php namespace App\OAuth;

use Illuminate\Support\Facades\Auth;

class PasswordVerifier
{
  public function verify($name, $password)
  {
      $credentials = [
        'name'    => $name,
        'password' => $password,
      ];

      if (Auth::once($credentials)) {
          return Auth::user()->id;
      }

      return false;
  }
}
