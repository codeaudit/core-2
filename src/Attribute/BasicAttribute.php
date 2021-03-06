<?php

namespace OpenDialogAi\Core\Attribute;

/**
 * BasicAttribute is a simple implementation of the AttributeInterface that
 * falls back on what PHP would do for comparisons and does not force any
 * specific type.
 */
class BasicAttribute extends AbstractAttribute
{
    /**
     * @param AttributeInterface $attribute
     * @param string $operation
     * @return bool
     * @throws UnsupportedAttributeTypeException
     */
    public function compare(AttributeInterface $attribute, string $operation): bool
    {
        return $this->doComparison($attribute, $operation);
    }

    public function doComparison(AttributeInterface $attribute, string $operation): bool
    {
        switch ($operation) {
            case AbstractAttribute::EQUIVALENCE:
                return $this->testEquivalence($attribute);
                break;
            case AbstractAttribute::GREATER_THAN_OR_EQUAL:
                return $this->testGreaterThanOrEqual($attribute);
                break;
            case AbstractAttribute::GREATER_THAN:
                return $this->testGreaterThan($attribute);
                break;
            case AbstractAttribute::LESS_THAN_OR_EQUAL:
                return $this->testLessThanOrEqual($attribute);
                break;
            case AbstractAttribute::LESS_THAN:
                return $this->testLessThan($attribute);
                break;
            case AbstractAttribute::IN_SET:
                return $this->testIsInSet($attribute);
                break;
            case AbstractAttribute::NOT_IN_SET:
                return $this->testIsNotInSet($attribute);
                break;
            case AbstractAttribute::IS_SET:
                return $this->testIsSet();
                break;
            case AbstractAttribute::IS_NOT_SET:
                return $this->testIsNotSet();
                break;
            default:
                return false;
        }
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testEquivalence(AttributeInterface $attribute)
    {
        if ($this->getValue() === $attribute->getValue()) {
            return true;
        }
        return false;
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testGreaterThanOrEqual(AttributeInterface $attribute)
    {
        if ($this->getValue() >= $attribute->getValue()) {
            return true;
        }

        return false;
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testGreaterThan(AttributeInterface $attribute)
    {
        if ($this->getValue() > $attribute->getValue()) {
            return true;
        }

        return false;
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testLessThanOrEqual(AttributeInterface $attribute)
    {
        if ($this->getValue() <= $attribute->getValue()) {
            return true;
        }

        return false;
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testLessThan(AttributeInterface $attribute)
    {
        if ($this->getValue() < $attribute->getValue()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    private function testIsSet()
    {
        return $this->getValue() !== null && $this->getValue() !== '';
    }

    /**
     * @return bool
     */
    private function testIsNotSet()
    {
        return $this->getValue() === null || $this->getValue() === '';
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testIsInSet(AttributeInterface $attribute)
    {
        return in_array($attribute->getValue(), $this->getValue());
    }

    /**
     * @param AttributeInterface $attribute
     * @return bool
     */
    private function testIsNotInSet(AttributeInterface $attribute)
    {
        return !in_array($attribute->getValue(), $this->getValue());
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string) $this->getValue();
    }
}
