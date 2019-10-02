Installation
============

Install the bundle with composer

.. code-block:: bash

    composer require flexsounds/api-behavior-bundle

Enable the bundle (no flex recipe):

Symfony 4

.. code-block:: php

    #bundles.php
    Flexsounds\Bundle\ApiBehavior\FlexsoundsApiBehaviorBundle::class => ['all' => true],


Symfony 3

.. code-block:: php

    $bundles[] = new Flexsounds\Bundle\ApiBehavior\FlexsoundsApiBehaviorBundle();

Configuration
-------------

This bundle contains no bundle configuration. We try to keep the configuration
to a bare minimum.