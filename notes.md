
# Building Database Applications in PHP

Start: 07/17/2024
End:

Sessions:
- 07/17/2024

# OOP in PHP

This course promises to go on full speed and more. Let's see if he can make up to his words.

Looks like this modules will be the general OOP talk.
Php uses the same arrow operator to access attributes and methods like C uses them to access values on structs.
Also, when defining methods, we can access the reference of the class or object by using "$this".

We can define static attributes by using "const" before defining a normal variable inside the class.
Also, in order to access these static items, we have to use this operator "::".

There's nice stuff like the life cycle, that uses some special methods just like python. Some of theese are:
- \_\_construct: The init and constructor of the obj, nothing fancy
- \_\_destruct: The destoy of the obj, something new and nice

Awww man, they only explained those two, but skipped the others shown.

Inheritance can be done by this syntax:

class foo extends bar {
    ...
}

## DBs and PDO 

In the old days of PHP 5\< We had to use something called sql routines, where we had to use a specifict database function, usage and general implementation.
Now, we use the PDO, included with php 5\>

Hahah in my old job we used sql routines.

With the new PDO, we have a syntax for the connection url, which includes almost everything needed for the connection.
Generally we make a connection for each request and almost every file, so in order to avoid having to make the conection in each
file we just make a connection file which we just require once everytime we need.

Some of the great stuff that we can do with PDO is avoiding SQL injection by passing an Array with keys when we execute 
an SQL Query. By naming theese keys with a : in the beggining and using them in the string of the query that we made.

Other cool stuff is the way that we can fetch rows. But that is mostly made with OOP stuff.

Handling errors with the PDO comes mainly from what and how we whant to handle our errors. 
Any of theese ways must have been added as a attribute on the contection of the PDO. Some of they are:
- ERRMODE\_SILENT: Nothing shows up
- ERRMODE\_WARNING: A warning shows up, but the code still executes
- ERRMODE\_EXCEPTIO: Stops everything and displays an error msg

The recomended one is the lastone, but we should also catch the error and print a general error 
so we don't show anything private or important in the error to the user.

The try catch part usage is the general syntax in almost all languages with the php extra stuff.
