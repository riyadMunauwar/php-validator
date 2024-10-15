<?php
// src/Rules/EmailRule.php

namespace MyValidator\Rules;

class EmailRule implements RuleInterface {
    public function validate($field, $value, $params): bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function message(): string {
        return 'validation.email';
    }
}
