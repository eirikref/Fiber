# Configuration Format

## General

Configuration can be passed either as JSON or as a PHP array (as the
first thing we will do is to convert the JSON string to an array
anyway).


## Top-Level Configuration

Configuration passed for calls to the top-level `Fiber` class needs to
be an array that may consist of three things, all of which are
optional:

1. An array of modules to either include or exclude. This parameter is
   either called `include` if you want to start with an empty set of
   modules and only include the ones you list, or `exclude` if you
   want to start with the full set of modules and use all of them
   except for the ones you list.

2. Module specific configuration that will be passed on down to the
   module(s) in question. The lowercased name of the module is used as
   the key in the array/JSON data structure, while the parameter needs
   to be an array as defined in the module specific configuration
   below.

3. A special case parameter `value`, which is used for fields that
   should not be generated but just have the same value for every item
   in the set of generated data. Ie. a string, an int, a boolean
   `true`, etc.

### Examples

Generate a list with one parameter per element, and that parameter
should be of types string, int, and float.

```json
[
    {"include": ["string", "int", "float"]}
]
```

```php
array(array("include" => array("string", "int", "float")));
```


A list with two parameters per element; the first one consisting of
all kinds of objects and arrays, the other of all kinds of strings.

```json
[
    {"exclude": ["object", "array"]},
    {"include": ["string"]}
]
```

```php
array(array("exclude" => array("object", "array")),
      array("include" => array("string"))
     );
```

Generate a set with just a single parameter per element. The element
should contain all kinds of string and int, and we supply module
specific configuration for both strings and ints.

```json
[
    {
        "include": ["string", "int"],
        "string": [ ... ],
        "int": [ ... ]
    }
]
```

```php
array(array("exclude" => array("object", "array"),
            "string"  => array( ... ),
            "int"     => array( ... )
           )
     );
```

Generate a set with three parameters; the first one is the static
string `some text` for all elements, the second one is a set of all
kinds of strings (depending on the module specific configuration
provided), and the last one is an int which is always `12`.

```json
[
    {
        "value": "some text"
    },
    {
        "include": ["string"],
        "string": [ ... ]
    },
    {
        "value": 12
    }
]
```

```php
array(array("value"   => "some text"),
      array("include" => array("string"),
            "string"  => array( ... )
           ),
      array("value"   => 12)
     );
```


## Single Module Access

It is also possible to generate test data for a single module
(ie. similar to passing config with `"include": "string"`) by calling
`get()` on the module itself (ie. `String::get()`.

Configuration may also be called for these calls, but
`include/exclude` will of course be ignored, and the same goes for
module specific configuration for other modules than the one in
question.


## Module Specific Configuration

TBD.