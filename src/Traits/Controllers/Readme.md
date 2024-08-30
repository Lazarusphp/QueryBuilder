# Using Orm Sql methods

In order to add and manipulate data from a database sql Statements are required, this is made possible witht the orm sql Methods;

Currently Supported  methods

* select
* insert
* update
* delete


## Select Method
in order to retrieve Data from the database you can simply call the select method

```
$users = new Users();
// returns the following statement SELECT * FROM users;
$users->select();
```
 the select method can also select specific columns by adding  parameters into the method itself like

 ```
$users = new Users();
// returns the following statement SELECT username,email FROM users;
$users->select("username","email");
```

By choosing specific colums within thje parameter calling a column not listed will result in a property not found error.


> Please note that applying the ->save() method is required to Execute the sql statment
