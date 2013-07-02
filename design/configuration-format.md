# Configuration Format

## General

Configuration can be passed either as JSON or as a PHP array (as the
first thing we will do is to convert the JSON string to an array
anyway).


## Top-Level Configuration

Configuration passed for calls to the top-level `Fiber` class may
consist of three things that are all optional:

1. An array of modules to either include or exclude. This parameter is
   either called `include` if you want to start with an empty set of
   modules and only include the ones you list, or `exclude` if you
   want to start with the full set of modules and run all of them
   except the ones you list.

2. Module-specific configuration that will be passed on down to the
   module(s) in question. The lowercased name of the module is used as
   the key in the array/JSON data structure, while the parameter needs
   to be an array as defined in the module specific configuration
   below.

3. A parameter used to describe the fields/items of the output
   array. The parameter is named `output` and must be an array.


### Examples

```json
{
    "include": ["string", "int", "float"]
}
```

```json
{
    "exclude": ["object", "array"]
}
```

```json
{
    "include": ["string", "int"],
    "string": [ ... ],
    "int": [ ... ]
}
```

```json
{
    "include": ["string"],
    "string": [ ... ],
    "output": ["some text", "__GEN__", "__GEN__"]
}
```

## Module Specific Configuration

TBD.