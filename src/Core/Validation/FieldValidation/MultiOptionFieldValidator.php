<?php

namespace SilverStripe\Core\Validation\FieldValidation;

use InvalidArgumentException;
use SilverStripe\Core\Validation\ValidationResult;
use SilverStripe\Core\Validation\FieldValidation\OptionFieldValidator;

/**
 * Validates that that all values are one of a set of options
 */
class MultiOptionFieldValidator extends OptionFieldValidator
{
    /**
     * @param mixed $value - an array of values to be validated
     */
    public function __construct(string $name, mixed $value, array $options)
    {
        if (!is_iterable($value) && !is_null($value)) {
            throw new InvalidArgumentException('Value must be iterable');
        }
        parent::__construct($name, $value, $options);
    }

    protected function validateValue(): ValidationResult
    {
        $result = ValidationResult::create();
        foreach ($this->value as $value) {
            $this->checkValueInOptions($value, $result);
        }
        return $result;
    }
}
