<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\CodeQuality\Rector\Assign\CombinedAssignRector;
use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;
use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;
use Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector;
use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;
use Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\CompleteMissingIfElseBracketRector;
use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;
use Rector\CodeQuality\Rector\If_\ShortenElseIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector;
use Rector\CodeQuality\Rector\NullsafeMethodCall\CleanupUnneededNullsafeOperatorRector;
use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;
use Rector\CodeQuality\Rector\Ternary\SimplifyTautologyTernaryRector;
use Rector\CodeQuality\Rector\Ternary\SwitchNegatedTernaryRector;
use Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use RectorLaravel\Rector\Class_\AnonymousMigrationsRector;
use RectorLaravel\Rector\ClassMethod\AddArgumentDefaultValueRector;
use RectorLaravel\Rector\ClassMethod\AddGenericReturnTypeToRelationsRector;
use RectorLaravel\Rector\ClassMethod\AddParentBootToModelClassMethodRector;
use RectorLaravel\Rector\ClassMethod\AddParentRegisterToEventServiceProviderRector;
use RectorLaravel\Rector\Expr\SubStrToStartsWithOrEndsWithStaticMethodCallRector\SubStrToStartsWithOrEndsWithStaticMethodCallRector;
use RectorLaravel\Rector\FuncCall\RemoveDumpDataDeadCodeRector;
use RectorLaravel\Rector\If_\AbortIfRector;
use RectorLaravel\Rector\If_\ThrowIfRector;
use RectorLaravel\Rector\MethodCall\EloquentWhereRelationTypeHintingParameterRector;
use RectorLaravel\Rector\MethodCall\RedirectBackToBackHelperRector;
use RectorLaravel\Rector\MethodCall\RedirectRouteToToRouteHelperRector;
use RectorLaravel\Rector\MethodCall\ValidationRuleArrayStringValueToArrayRector;
use RectorLaravel\Set\LaravelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames();

    $rectorConfig
        ->paths([
            __DIR__ . '/app',
            __DIR__ . '/config',
            __DIR__ . '/resources',
            __DIR__ . '/database',
            __DIR__ . '/routes',
            __DIR__ . '/src',
            __DIR__ . '/tests',
        ]);

    $rectorConfig->sets([
        SetList::DEAD_CODE,
        SetList::PHP_83,
        SetList::TYPE_DECLARATION,
        LaravelSetList::LARAVEL_LEGACY_FACTORIES_TO_CLASSES,
        LaravelSetList::LARAVEL_CODE_QUALITY,
        LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER,
        LaravelSetList::LARAVEL_120,
        LevelSetList::UP_TO_PHP_83,
    ]);

    $rectorConfig->rules([
        RedirectRouteToToRouteHelperRector::class,
        AddVoidReturnTypeWhereNoReturnRector::class,
        AbortIfRector::class,
        ThrowIfRector::class,
        AddParentBootToModelClassMethodRector::class,
        AnonymousMigrationsRector::class,
        RedirectBackToBackHelperRector::class,
        RemoveDumpDataDeadCodeRector::class,
        AddArgumentDefaultValueRector::class,
        AddGenericReturnTypeToRelationsRector::class,
        AddParentRegisterToEventServiceProviderRector::class,
        EloquentWhereRelationTypeHintingParameterRector::class,
        SubStrToStartsWithOrEndsWithStaticMethodCallRector::class,
        ValidationRuleArrayStringValueToArrayRector::class,
        ArgumentAdderRector::class,
        ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        CleanupUnneededNullsafeOperatorRector::class,
        RecastingRemovalRector::class,

        // code quality
        ArrayMergeOfNonArraysToSimpleArrayRector::class,
        BooleanNotIdenticalToNotIdenticalRector::class,
        ChangeArrayPushToArrayAssignRector::class,
        CombineIfRector::class,
        CombinedAssignRector::class,
        CompleteDynamicPropertiesRector::class,
        CompleteMissingIfElseBracketRector::class,
        ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        ShortenElseIfRector::class,
        SimplifyConditionsRector::class,
        SimplifyIfElseToTernaryRector::class,
        SimplifyIfNullableReturnRector::class,
        SimplifyRegexPatternRector::class,
        SimplifyTautologyTernaryRector::class,
        SwitchNegatedTernaryRector::class,
        UnnecessaryTernaryExpressionRector::class,
        UseIdenticalOverEqualWithSameTypeRector::class,
    ]);

    // Ensure file system caching is used instead of in-memory.
    $rectorConfig->cacheClass(FileCacheStorage::class);

    // Specify a path that works locally as well as on CI job runners.
    $rectorConfig->cacheDirectory('./storage/rector/cache');
};
