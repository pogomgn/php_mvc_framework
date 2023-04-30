<?php

namespace App\Enums;

enum ValidateRule: string
{
    case REQUIRED = 'required';
    case EMAIL = 'email';
    case MIN = 'min';
    case MAX = 'max';
    case MATCH = 'match';
}