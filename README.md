Api Toolkit Bundle
============

This bundle provides some additioal tools for the Symfony Framework to create API's. 

It is loosely based on Spring Boot REST. 

## Installation

Add dependency:

```sh
composer require flexsounds/api-behavior-bundle
```

Enable bundle:

Symfony 4

```php
#bundles.php
Flexsounds\Bundle\ApiBehavior\FlexsoundsApiBehaviorBundle::class => ['all' => true],
```

Symfony 3

```php
$bundles[] = new Flexsounds\Bundle\ApiBehavior\FlexsoundsApiBehaviorBundle();
```

## Configuration

This bundle contains no bundle configuration. We try to keep the configuration
to a bare minimum. 

## Usage

### `@RequestMapping` Annotations for stricter HTTP verbs

You can annotate your methods with a stricter version of Symfony's `@Route`.

```php
class BlogController
{
    /**
     * @GetMapping("/blog")
     */
    public function list(): Response
    {
        // Your logic here
    }
    
    /**
     * @PostMapping("/blog")
     */
    public function create(): Response
    {
        // Your logic here
    }
}
``` 

There's support for the following Mappings

| Annotation       | Description      |
|------------------|------------------|
| `@GetMapping`    | HTTP GET Verb    |
| `@PostMapping`   | HTTP POST Verb   |
| `@PutMapping`    | HTTP PUT Verb    |
| `@PatchMapping`  | HTTP PATCH Verb  |
| `@DeleteMapping` | HTTP DELETE Verb |


### `@RequestBody` Annotation

The `RequestBody` annotation converts the Request Body to any object. It
is limited to `json` body's only. The object can be injected as a controller
method argument.

```php

class BlogController
{
    /**
     * @PostMapping("/blog")
     * @RequestBody("model")
     */
    public function foo(CreateBlogModel $model): Response
    {
        // Your logic here
    }
}

```  


You have to manually validate the model if you have any validation constraints
on it.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
