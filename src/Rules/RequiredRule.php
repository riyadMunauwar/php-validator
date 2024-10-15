<?php
// src/Rules/RequiredRule.php

namespace MyValidator\Rules;

class RequiredRule implements RuleInterface {
    public function validate($field, $value, $params): bool {
        return !empty($value);
    }

    public function message(): string {
        return 'validation.required';
    }
}
