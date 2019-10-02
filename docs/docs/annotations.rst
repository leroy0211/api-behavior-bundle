Annotations
===========


`@RequestMapping` Annotations for stricter HTTP verbs
-----------------------------------------------------

You can annotate your methods with a stricter version of Symfony's `@Route`.

.. code-block:: php

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


There's support for the following Mappings

=================== ===================
Annotation          Description
=================== ===================
``@GetMapping``     HTTP GET Verb
``@PostMapping``    HTTP POST Verb
``@PutMapping``     HTTP PUT Verb
``@PatchMapping``   HTTP PATCH Verb
``@DeleteMapping``  HTTP DELETE Verb
=================== ===================


`@RequestBody`
--------------

The ``RequestBody`` annotation converts the Request Body to any object. It
is limited to ``json`` body's only. The object can be injected as a controller
method argument.

.. code-block:: php

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



You have to manually validate the model if you have any validation constraints
on it.


`@ResponseBody`
---------------

The `ResponseBody` annotation lets you use any return value in a controller,
as long as it can be serialized. It is limited to a `json` response only.

.. code-block:: php

    class FooController
    {
        /**
         * @ResponseBody()
         */
        public function bool(): Response
        {
            return true;
        }

        /**
         * @ResponseBody()
         */
        public function array(): Response
        {
            return ['foo', 'bar'];
        }

        /**
         * @ResponseBody()
         */
        public function objects(): Response
        {
            return new Foo();
        }
    }