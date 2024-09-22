<?php

namespace App\Core;


class Validator {
    private $errors = [];

    public function validate(array $data, array $rules) {
        foreach ($rules as $field => $rule) {
            // Check for wildcard patterns
            if (strpos($field, '.*') !== false) {
                $baseField = explode('.', $field)[0]; // Get the base field name
                foreach ($data[$baseField] as $index => $value) {
                    $this->applyRule("{$baseField}.{$index}", $value, $rule);
                }
            } else {
                $value = $data[$field] ?? null;
                $this->applyRule($field, $value, $rule);
            }
        }
    }

    private function applyRule($field, $value, $rule) {
        if (strpos($rule, 'required') !== false && empty($value)) {
            $this->errors[$field][] = "$field is required.";
        }

        if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Invalid email format for $field.";
        }

        // Add more rules as needed
    }

    public function getErrors() {
        return $this->errors;
    }

    public function fails() {
        return !empty($this->errors);
    }
}
