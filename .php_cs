<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('Tests/Fixtures')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
;
