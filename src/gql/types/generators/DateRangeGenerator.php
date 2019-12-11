<?php

namespace studioespresso\daterange\gql\types\generators;

use craft\gql\base\GeneratorInterface;
use craft\gql\GqlEntityRegistry;
use craft\gql\TypeLoader;
use craft\gql\types\DateTime;
use GraphQL\Type\Definition\Type;
use studioespresso\daterange\gql\types\DateRangeType;

/**
 * @author    Studio Espresso
 * @package   DateRange
 * @since     1.3.0
 */
class DateRangeGenerator implements GeneratorInterface
{
    // Public Static methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function generateTypes($context = null): array
    {
        /** @var OptimizedImages $context */
        $typeName = self::getName($context);

        $props = [
            // static fields
            'start' => [
                'name' => 'start',
                'description' => 'The start date and time',
                'type' => DateTime::getType(),
            ],
            'end' => [
                'name' => 'end',
                'description' => 'The end date and time',
                'type' => DateTime::getType(),
            ],
        ];
        $dateRangeType = GqlEntityRegistry::getEntity($typeName)
            ?: GqlEntityRegistry::createEntity($typeName, new DateRangeType([
            'name' => $typeName,
            'description' => 'This entity has the DateRange properties',
            'fields' => function () use ($props) {
                return $props;
            },
            ]));

        TypeLoader::registerType($typeName, function () use ($dateRangeType) {
            return $dateRangeType;
        });

        return [$dateRangeType];
    }

    /**
     * @inheritdoc
     */
    public static function getName($context = null): string
    {
        /** @var OptimizedImages $context */
        return $context->handle.'_OptimizedImages';
    }
}
