<?php

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHPUnit48Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'fopen_flags' => false,
        'ordered_imports' => true,
        'protected_to_private' => false,
        'phpdoc_types_order' => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'],
        'psr_autoloading' => false,
        'phpdoc_to_comment' => false,
        'php_unit_test_annotation' => false, // weil der Change Risky ist und wir keine einheitliche Konvention etabliert haben
        'php_unit_method_casing' => false, // dto
        'phpdoc_separation' => ['skip_unlisted_annotations' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/pull/6668; antizipiert das Default der nächsten Major Version
        /* Symfony-webfactory-Edition sagt:
        'php_unit_test_annotation' => ['style' => 'annotation'],
        'php_unit_method_casing' => false,
        */
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([__DIR__.'/src', __DIR__.'/www'])
            ->append([__FILE__])
            ->exclude([
            ])
    )
;
