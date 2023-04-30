<?php


namespace App\Models;


use App\Enums\ValidateRule;

class RegisterModel extends BaseModel
{
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $passConfirm;

    public function register(): bool
    {
        if ($this->errors) {
            return false;
        }


        return true;
    }

    protected function rules(): array
    {
        return [
            'name' => [
                ValidateRule::REQUIRED,
                [ValidateRule::MIN, 3],
            ],
            'email' => [
                ValidateRule::REQUIRED,
                ValidateRule::EMAIL,
            ],
            'password' => [
                ValidateRule::REQUIRED,
                [ValidateRule::MIN, 3],
            ],
            'passConfirm' => [
                ValidateRule::REQUIRED,
                [ValidateRule::MIN, 3],
                [ValidateRule::MATCH, 'password'],
            ],
        ];
    }
}