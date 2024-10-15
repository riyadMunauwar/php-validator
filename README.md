# **MyValidator Library**

A lightweight and extensible PHP validation library inspired by Laravel's Validator. This library supports multiple rules, localization, and custom error messages, making it suitable for standalone PHP projects.

---

## **Features**

- **Rule-based validation** (e.g., `required`, `email`, `min`)
- **Localization support** (Multi-language error messages)
- **Custom rules** for extensibility
- **Error handling and formatting**
- **Simple API** for easy integration

---

## **Installation**

1. **Clone the repository** or **download the source** files.  
2. Run the following command to autoload classes using Composer:

   ```bash
   composer dump-autoload
   ```

---

## **Project Structure**

```
my-validator/
│
├── src/
│   ├── Validator.php          # Main Validator class
│   ├── Rules/                 # Folder for rule classes
│   │   ├── RuleInterface.php  # Interface for rules
│   │   ├── RequiredRule.php   # 'required' rule
│   │   ├── EmailRule.php      # 'email' rule
│   │   ├── MinRule.php        # 'min' rule
│   ├── Translator.php         # Handles localization
│   └── Messages/              # Language message files
│       ├── en.php             # English messages
│       ├── es.php             # Spanish messages
│       └── bn.php             # Bangla messages
├── examples/
│   └── Example.php              # Example usage
├── composer.json              # Composer configuration
└── README.md                  # Documentation
```

---

## **Usage Example**

Below is an example of how to use the `MyValidator` library in a PHP project.

```php
<?php
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

$translator = new Translator('bn');  // Use 'en' for English or 'es' for Spanish
$validator = new Validator($data, $rules, $translator);

if ($validator->validate()) {
    echo "Validation passed!";
} else {
    print_r($validator->errors());
}
```

### **Expected Output (If Validation Fails)**

```
Array
(
    [name] => Array
        (
            [0] => name ঘরটি অবশ্যই পূরণ করতে হবে।
        )

    [email] => Array
        (
            [0] => email একটি বৈধ ইমেইল ঠিকানা হতে হবে।
        )

    [password] => Array
        (
            [0] => password অবশ্যই কমপক্ষে ৬ অক্ষর হতে হবে।
        )
)
```

---

## **Rules Overview**

Below is a summary of the built-in rules and how they behave:

| **Rule**   | **Description**                        | **Example Usage**        |
|------------|----------------------------------------|--------------------------|
| `required` | Ensures the field is not empty         | `'name' => ['required']` |
| `email`    | Ensures the field contains a valid email address | `'email' => ['email']` |
| `min`      | Ensures the field meets a minimum length | `'password' => [['min', 6]]` |

---

## **Localization**

The library supports **multi-language error messages**. You can select a language by passing the locale to the `Translator` class. 

### Available Language Files:
- **English** (`en.php`)
- **Spanish** (`es.php`)
- **Bangla** (`bn.php`)

**Example:**

To switch to **Bangla** localization:

```php
$translator = new Translator('bn');
```

---

## **Creating Custom Rules**

You can extend the library by adding custom rules. To create a new rule, follow these steps:

1. **Create a new class** inside the `src/Rules/` directory.
2. **Implement the `RuleInterface`**.

Example: `MaxRule.php`

```php
<?php
namespace MyValidator\Rules;

class MaxRule implements RuleInterface {
    public function validate($field, $value, $params): bool {
        return strlen($value) <= $params[0];
    }

    public function message(): string {
        return 'validation.max';
    }
}
```

3. **Add the message** in the relevant language files:

`Messages/en.php`:
```php
'validation.max' => 'The :field must not exceed :max characters.',
```

Now you can use the custom rule in your validation logic:

```php
$rules = [
    'username' => [['max', 10]]
];
```

---

## **Error Handling**

You can retrieve all validation errors by calling the `errors()` method on the `Validator` instance:

```php
if (!$validator->validate()) {
    print_r($validator->errors());
}
```

The `errors()` method returns an associative array with field names as keys and an array of error messages as values.

---

## **Contributing**

To contribute to the development of this library:

1. Fork the repository.
2. Create a new feature branch.
3. Submit a pull request with a detailed description of the changes.

---

## **License**

This library is open-source and available under the [MIT License](https://opensource.org/licenses/MIT). You are free to use, modify, and distribute it as needed.

---

## **Contact and Support**

For any issues or questions, feel free to create an issue on the repository or contact the maintainer directly.
