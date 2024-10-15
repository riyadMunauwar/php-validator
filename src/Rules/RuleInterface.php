<?php
// src/Rules/RuleInterface.php

namespace MyValidator\Rules;

interface RuleInterface {
    public function validate($field, $value, $params): bool;
    public function message(): string;
}
