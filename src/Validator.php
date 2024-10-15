<?php
// src/Validator.php

namespace MyValidator;

use MyValidator\Rules\RuleInterface;

class Validator {
    protected $data;
    protected $rules;
    protected $translator;
    protected $errors = [];

    public function __construct(array $data, array $rules, Translator $translator) {
        $this->data = $data;
        $this->rules = $rules;
        $this->translator = $translator;
    }

    public function validate(): bool {
        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                [$ruleName, $params] = $this->parseRule($rule);
                $ruleInstance = $this->getRuleInstance($ruleName);

                if (!$ruleInstance->validate($field, $this->data[$field] ?? null, $params)) {
                    $this->addError($field, $ruleInstance->message(), $params);
                }
            }
        }

        return empty($this->errors);
    }

    protected function parseRule($rule) {
        if (is_string($rule)) {
            return [$rule, []];
        } elseif (is_array($rule)) {
            $name = array_shift($rule);
            return [$name, $rule];
        }
    }

    protected function getRuleInstance($ruleName): RuleInterface {
        $class = "MyValidator\\Rules\\" . ucfirst($ruleName) . "Rule";
        return new $class;
    }

    protected function addError($field, $messageKey, $params) {
        $message = $this->translator->get($messageKey, array_merge(['field' => $field], $params));
        $this->errors[$field][] = $message;
    }

    public function errors(): array {
        return $this->errors;
    }
}
