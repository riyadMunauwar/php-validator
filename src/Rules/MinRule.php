<?php
// src/Rules/MinRule.php

namespace MyValidator\Rules;

class MinRule implements RuleInterface {
    public function validate($field, $value, $params): bool {
        return strlen($value) >= $params[0];
    }

    public function message(): string {
        return 'validation.min';
    }
}
