<?php
// examples/index.php

require __DIR__ . '/../vendor/autoload.php';

use MyValidator\Validator;
use MyValidator\Translator;

$data = [
    'name' => '',
    'email' => 'invalid-email',
    'password' => '123'
];

$rules = [
    'name' => ['required'],
    'email' => ['required', 'email'],
    'password' => [['min', 6]]
];

$translator = new Translator('en');  // Use 'es' for Spanish
$validator = new Validator($data, $rules, $translator);

if ($validator->validate()) {
    echo "Validation passed!";
} else {
    print_r($validator->errors());
}
