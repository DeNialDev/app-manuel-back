<?php

namespace App\Http\Requests\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordValid implements Rule
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function passes($attribute, $value)
    {
        $user = User::query()->where('email', $this->email)->first();
        if (! $user) {
            return true;
        }

        return Hash::check($value, $user->password);
    }

    public function message()
    {
        return 'Las credenciales no son correctas';
    }
}
