:bundle_class
============

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

Skeleton project for new Symfony bundles.

## Setup

1. Do a search/replace for the following fields in all project files:

   ```
   :package_name => foo-bar-bundle            # identifier for packagist et al
   :bundle_class => FooBar                    # the bundle's name, classified like a class name
   :bundle_namespace => FooBarBundle          # the bundle's namespace
   :bundle_alias => foo_bar                   # alias used by Symfony, will be prefixed with "tree_house_"
   :bundle_description => Foo bar bundle      # a description used for the readme and composer.json
   :author_name => Peter Kruithof             # your name
   author@treehouse.nl => peter@treehouse.nl  # your email, note the missing colon here
   :author_github => pkruithof                # GitHub handle
   ```
2. Rename the following files, replacing `Skeleton` with `:bundle_class`:

   ```sh
   src/TreeHouse/SkeletonBundle
   src/TreeHouse/SkeletonBundle/DependencyInjection/TreeHouseSkeletonExtension.php
   src/TreeHouse/SkeletonBundle/TreeHouseSkeletonBundle.php
   tests/TreeHouse/SkeletonBundle
   ```
3. Delete this section from the readme


:bundle_description


## Usage

Describe shortly what the bundle does and how to use it.


## Documentation

1. [Setup][doc-setup]

[doc-setup]: /docs/01-setup.md


## Security

If you discover any security related issues, please email dev@treehouse.nl
instead of using the issue tracker.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


## Credits

- [:author_name][link-author]
- [All Contributors][link-contributors]


[ico-version]:       https://img.shields.io/packagist/v/treehouselabs/:package_name.svg?style=flat-square
[ico-license]:       https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]:        https://img.shields.io/travis/treehouselabs/:package_name/master.svg?style=flat-square
[ico-scrutinizer]:   https://img.shields.io/scrutinizer/coverage/g/treehouselabs/:package_name.svg?style=flat-square
[ico-code-quality]:  https://img.shields.io/scrutinizer/g/treehouselabs/:package_name.svg?style=flat-square
[ico-downloads]:     https://img.shields.io/packagist/dt/treehouselabs/:package_name.svg?style=flat-square

[link-packagist]:    https://packagist.org/packages/treehouselabs/:package_name
[link-travis]:       https://travis-ci.org/treehouselabs/:package_name
[link-scrutinizer]:  https://scrutinizer-ci.com/g/treehouselabs/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/treehouselabs/:package_name
[link-downloads]:    https://packagist.org/packages/treehouselabs/:package_name
[link-author]:       https://github.com/:author_github
[link-contributors]: ../../contributors
