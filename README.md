# Fiber [![Build Status](https://secure.travis-ci.org/eirikref/Fiber.png?branch=master)](http://travis-ci.org/eirikref/Fiber)

Fiber is work-in-progress, or maybe just a dream-in-progress at this
point. It is supposed to become a simple, small library for generating
test data for use in PHPUnit unit tests.

Starting to write my PHP library Loom from scratch, I really wanted to
test everything properly from day one. If my method is supposed to
accept a string, what happens if I send in booleans, objects, arrays,
null, floats, and so on? What happens if I send in empty strings? Or a
ridiculously long string?

Do I want to recreate all possible input data test cases for each
test? No. Hence Fiber, which will hopefully provide a simple interface
for generating the proper test data to be used in PHPUnit's
dataProvider methods.


## Requirements and Thoughts

* I should return test data that is easy to handle inside a PHPUnit
  DataProvider method, that is **return arrays of test data** that can
  be easily merged and then returned from the DataProvider

* I should be able to generate and **export the test data**, since you
  might not want your test cases to depend on dynamically generated
  test data from a third-party library. I know I would be slightly
  skeptical myself.

* Still, let us say we have a method that accepts a string longer than
  m but shorter than n. We should be able to generate a string that is
  longer than n, and **generate it the exact same way over and over
  again** in order to provide consistent test data.

* But we should **also be able to generate test data with random
  values** every time if we want to.

* The two most important use-cases is to get a bunch of test cases
  that are **either all valid or all invalid** (in the context of what
  I have asked for).

* Not quite sure if I should do everything through a central
  class/object `Fiber`, through separate classes (ie. `String`,
  `Boolean`, etc), or both.

* Not quite sure if I should use static methods,
  ie. `String::getSomething()`, or if I should use objects.

* Not quite sure about the format of `$this->options`, and how I will
  let users configure what they want. Needs to be flexible, but still
  robust. Unlike how it is now.

* I should probably support configuration for both the central `Fiber`
  and the subclasses, and if I pass configuration to `Fiber` the
  relevant parts should be delegated to the subclasses.

* Even if I support a simple, yet flexible way of configuring
  everything, I guess I should still supply a **nice set of helper
  methods** for accessing common things without having to pass a lot
  of configuration.

* Thoughts on what I need the String class to provide: empty string,
  strings of different length (not yet sure if I should provide
  certain default lengths or what), strings that are obviously too
  long, options should probably have a min/max length setting,
  all lowercase, all uppercase


## Thoughts on Possible Usage

* All calls return an array that is directly usable by PHPUnit.

* Config should be JSON, with either whitelisting or blacklisting of
  what we want/do not want.


```php
// Just return all possible kinds of data
$data = Fiber::get();

// Exclude strings, but get everything else
$cfg  = '{"exclude": "string"}';
$data = Fiber::get($cfg);

// Only include integers and floats
$cfg  = '{"include": "integer, float"}';
$data = Fiber::get($cfg);
´´´
