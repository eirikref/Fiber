# Fiber <a style="float: right;" align="right" href="http://travis-ci.org/eirikref/Fiber"><img style="float: right;" align="right" src="https://secure.travis-ci.org/eirikref/Fiber.png?branch=master"></a>

Fiber is a work-in-progress library for generating test data for use
in PHPUnit unit tests.

So your method expects the parameter to be a string of 8-32 characters
[a-zA-Z0-9]? OK, let us make it easy for you to write data providers
testing both valid and invalid values; ints, floats, arrays, objects,
booleans, etc. Strings of various lengths, edge cases, different
character sets, etc.


## Expected Usage (Once We're Done)
```php
// Just return all possible kinds of data
$fiber = new Fiber();
$data = $fiber->get();

// Exclude strings, but get everything else
$cfg  = '{"exclude": "string"}';
$data = $fiber->get($cfg);

// Only include integers and floats
$cfg  = '{"include": "integer, float"}';
$data = $fiber->get($cfg);

// Another thought
$fiber->getOnly("string", "length: 1-32, charset: utf8");
$fiber->getAnythingBut("string", "length: 1-32, charset: utf8");
```
