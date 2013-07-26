# Fiber: Requirements and Thoughts


## Output

* I should return test data that is easy to handle inside a PHPUnit
  DataProvider method, that is **return arrays of test data** that can
  be easily merged (or already merged inside Fiber) and then returned
  from the DataProvider

* I should be able to generate and **export the test data**, since you
  might not want your test cases to depend on dynamically generated
  output from a third-party library. I know I would be slightly
  skeptical myself.

* Still, let us say we have a method that accepts a string longer than
  m but shorter than n. We should be able to generate a string that is
  longer than n, and **generate it the exact same way over and over
  again** in order to provide consistent test data.

* But we should **also be able to generate test data with random
  values** every time if we want to.


## Usage

* The two most important use-cases is to get a bunch of test cases
  that are **either all valid or all invalid** (in the context of what
  I have asked for).

* Not quite sure if I should do everything through a central
  class/object `Fiber`, through separate classes (ie. `String`,
  `Boolean`, etc), or both.

* Not quite sure if I should use static methods,
  ie. `String::getSomething()`, or if I should use objects.

* Even if I support a simple, yet flexible way of configuring
  everything, I guess I should still supply a **nice set of helper
  methods** for accessing common things without having to pass a lot
  of configuration.



## Implementation Details

* I should probably support configuration for both the central `Fiber`
  and the subclasses, and if I pass configuration to `Fiber` the
  relevant parts should be delegated to the subclasses.


## Data Types

* Support custom DataTypes

### String

* Thoughts on what I need the String class to provide: empty string,
  strings of different length (not yet sure if I should provide
  certain default lengths or what), strings that are obviously too
  long, options should probably have a min/max length setting,
  all lowercase, all uppercase
