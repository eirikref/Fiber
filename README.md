# Fiber

Fiber is work-in-progress, or maybe just a dream-in-progress at this
point. It is supposed to become a simple, small library for generating
test data for use in PHPUnit unit tests.

Starting to write my PHP library Loom from scratch, I really wanted to
test everything properly from day one. If my method is supposed to
accept a string, what happens if I send in booleans, objects, arrays,
null, floats, and so on? What happens if I send in empty strings? Or a
ridiculously long string?

Do I want to recreate all possible input data test cases for each
test? No. Hence Fiber, which will hopefully provide a simple
interface for fetching the proper test data to be used in PHPUnit's
dataProvider methods.