
# Building Database Applications in PHP

Start: 07/17/2024
End: 09/06/2024

Sessions:
- 07/17/2024
- ...
- 08/04/2024
- ...
- 09/06/2024

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

## Cookies & Sessions

Cookies are a way to store data locally and temporaly in the web for the users.
Can be accessed by using $\_COOKIE, another global key-array, but you can set them by using:
setcookie('name', 'value');

Now we can use sessions, that are a more secure way of storing data for a user, in a 'session' like after login in or generaly information 
that we shouldn't let have the user have it for security propourses. Theese tend to be way smaller than cookies, mainly because they can affect a 
lot of the performance. To use them we use another global key-array $\_SESSION, but we can set keys without a function, but we have to start each time the session 
and destroy it once it's over with:
session\_start()
session\_destroy()

But if our app demands that we have to avoid using cookies and only use sessions, we can deactivate them with some config in the php.ini and 
by using the session\_id(). But theese kind of stuff has a lot of problemns like resuing login data, not beeing usable in anything but php itself, and others.

## Routing

By using the header function, we can pass an http header. Mainly for routing, we can redirect users by using the header 'Location: \<URL\>'
Then by just passing an return and the user will redirect to the URL and wont display if, it even loads, anything of the php script.
This was already implemented in multiple exercises and more, soo... this is a mouthfull of nothing.

Now we can implement POST / REDIRECT / GET so the user doesn't refresh the webpage on a POST and makes another POST of the form data, which could be kinda dangerous.
But generaly after a POST, we need to show some information, we can redirect to a custom view for the POST, and that kinda helps but if we need some information from the 
post, like a value, id, result or anything we need to use two things.

- Sessions data: We can save the result on the session, but that can be a little of problemn
- URL GET encoded data: By using url params and a base64 or any encoder and decoder we can use, and pass the data by the url just like a normal get. Also getting sort of a problemn

The problemn here is that if we need to pass a awful lot of info of the POST, there's a limit where the app can handle all the info, mainly because 
on the session, if we need to process it more or have it in the 'background' it'll make the requests a lot slower, and with the URL GET encoded data
might not even work at all for the limit of the length for an url in the browser.

So the best thing to do, is avoid passing a lot of data, and if you need to, try to pass a reference, id or anything that let 
you get and reconstruct that data on the GET view.


GOD I HATE/LOVE ZROK
