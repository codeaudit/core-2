<?php


namespace OpenDialogAi\AttributeEngine\AttributeResolver;


use OpenDialogAi\Core\Attribute\AbstractAttribute;
use OpenDialogAi\Core\Attribute\BasicAttribute;
use OpenDialogAi\Core\Attribute\AttributeInterface;
use OpenDialogAi\Core\Attribute\UnsupportedAttributeTypeException;

class AttributeResolverService
{
    const ATTRIBUTE_RESOLVER = 'attribute_resolver';

    public function __construct()
    {
        //@todo
    }

    public function getAvailableAttributes()
    {
        return config('opendialog.attribute_engine.available_attributes');
    }

    public function isAttributeSupported(string $attributeId)
    {
        //@todo
    }

    /**
     * @param string $attributeId
     * @return AttributeInterface
     * @throws UnsupportedAttributeTypeException
     */
    public function getAttributeFor(string $attributeId)
    {
        /* @var AttributeInterface $attribute */
        $attribute = new BasicAttribute('dummy_attribute', AbstractAttribute::STRING, 'dummy');
        return $attribute;
    }
}
