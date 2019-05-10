<?php

namespace OpenDialogAi\Core\Attribute;

use OpenDialogAi\Core\Attribute\Operation\OperationInterface;

/**
 * An Attribute is a perceivable feature of the environment (username, time, etc)
 * and through them entities (users, bots) and the environment in which they are
 * situated can be described.
 */
interface AttributeInterface
{
    public function allowedAttributeOperations();

    public function getId(): string;

    public function getType(): string;

    public function getValue();

    public function setValue($value);

    public function executeOperation(OperationInterface $operation): bool;

    public function toString(): string;
}
