<?php

namespace SilverStripe\Core\Validation\FieldValidation;

use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Core\Validation\FieldValidation\FieldValidator;

/**
 * Validates that a value is one of a set of options
 */
class OptionFieldValidator extends FieldValidator
{
    /**
     * A list of allowed values
     */
    protected array $options;

    public function __construct(string $name, mixed $value, array $options)
    {
        parent::__construct($name, $value);
        $this->options = $options;
    }

    protected function validateValue(): ValidationResult
    {
        $result = ValidationResult::create();
        $this->checkValueInOptions($this->value, $result);
        return $result;
    }

    protected function checkValueInOptions(mixed $value, ValidationResult $result): void
    {
        if (!in_array($value, $this->options, true)) {
            $message = _t(__CLASS__ . '.NOTALLOWED', 'Not an allowed value');
            $result->addFieldError($this->name, $message);
        }
    }
}
