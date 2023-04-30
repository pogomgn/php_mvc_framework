<?php

namespace App\Models;

use App\Enums\ValidateRule;

abstract class BaseModel
{
    protected array $errors = [];

    public function __construct()
    {
    }

    public function load(array $params): static
    {
        foreach ($params as $name => $value) {
            $this->$name = $value;
        }
        return $this;
    }

    abstract protected function rules(): array;

    public function validate(): bool
    {
        $paramRules = $this->rules();
        foreach ($paramRules as $code => $rules) {
            foreach ($rules as $rule) {
                if (is_array($rule)) {
                    $value = $rule[1];
                    $rule = $rule[0];
                }
                $valid = match ($rule) {
                    ValidateRule::MATCH => $this->$code === $this->$value,
                    ValidateRule::MIN => strlen($this->$code) >= $value,
                    ValidateRule::MAX => strlen($this->$code) <= $value,
                    ValidateRule::REQUIRED => !empty($this->$code),
                    ValidateRule::EMAIL => filter_var($this->$code, FILTER_VALIDATE_EMAIL),
                };
                if (!$valid) {
                    $this->errors[] = $rule->value . ' validation for ' . $code . ' field failed.';
                }
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}