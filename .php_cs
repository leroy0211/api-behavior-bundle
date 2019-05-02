<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src', 'tests'])
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
