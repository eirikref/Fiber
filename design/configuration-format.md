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
   should not be generated ut just have the same value for every item
   in the set of generated data. Ie. a string, an int, a boolean
   `true`, etc.

### Examples

```json
[
    {"include": ["string", "int", "float"]}
]
```

```json
[
    {"exclude": ["object", "array"]},
    {"include": ["string"]}
]
```

```json
[
    {
        "include": ["string", "int"],
        "string": [ ... ],
        "int": [ ... ]
    }
]
```

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

## Module Specific Configuration

TBD.