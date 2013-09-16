# General Design

## Class Fiber
* Public method __get()__, should accept config (both the verbose type
  (array or JSON) and the sort syntax)
* Private method __combineParams()__, for combining data sets in case
  of multiple params.
* Private methdod __discoverDataTypes()__ which looks at the
  __datatype__ section in .fiber.yml (if it exists), checks the listed
  directories for files containing subclasses of \Fiber\DataType, and
  includes them in the list of available types. Always include the
  native data types supplied by Fiber.

## Class DataType
* Abstract
* Public method __get()__, should check config (general and for the
  specific type), call the approprite class methods, build an array of
  the generated data, and return it.

## Directory DataType
* Repository of officially bundled data types (one class per type, all
  extending class DataType)
* These classes should ideally not need anything else than one method
  per generator (possibly private/protected helper methods)
* Public methods within these classes will be discovered and
  automatically run when generating data of tht type
* MAYBE: Optional private method __setup()__ (or similar) for looking
  at runtime config and determining which methods/generators to run)

## Class Config
* Handle array, JSON, and short syntax config alike, parse it to a
  config tree, and make it available to both class Fiber, DataType,
  and all the DataType subclasses.
* DECIDE: Not sure about the API.
* DECIDE: Not sure if it should be a singleton for the entire request
  (across Fiber and all the DataType subclasses) or not.
* DECIDE: Single-level vs multi-level access of settings.
