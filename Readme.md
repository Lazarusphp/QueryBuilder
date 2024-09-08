# LazarusQB

## What is LazarusQB ? 
Lazarus QB Is a small Library Designed to write Sql Statements into a readable format.

## Requirements

* Knowelege of php
* A webserver with support for php and composer
* lazarusphp/dbmanager Scripts (downloaed with composer install)

## How to install ?

```php
composer require lazarusphp/qb
```
> If you wish to modify this script to work with your own Database Setu
> You can just download the files from the Releases sections
>

## Whats included ? 

* Select
  * findorfail({id});
  * findbyid({$id});
* Insert
* Update
* Delete
* Joins (inner,left,right and cross)
* Where Statments
  * where
  * orwhere
  * in and not in
  * between and orBetween
  * like and not like orlike orNotlike
* Having
* Order by (support Multiple values)
* Group by

## How to use ?
As this script is designed to work with lazarusphp framework the following examples and guides will apply to QB

### Instantiating a Connection ?
LazarusQb is designed as a model Driven Query Builder, this means a Class is required in order to connect with the database.

###### Creating the class (Users.php)
```php
<?php
namespace App\Http\Model;

class Users extends Model
{

}
```

User.php once created is extended to Model, the Model class which eventually extends to the database via the QueryBuilder Core class

The Purpose of the Users.php is mainly to allow the user to Create and apply custom Query Builder Functions [More on Custom Code](https://github.com/Lazarusphp/orm/blob/main/Custom.md)

###### Making the Connection
Once a Model Class has been created the connection simply needs to be instantiated

```php
namespace App\Http\Controllers;
use App\Http\Model\Users;
class HomeController
{
    public function index()
    {
        $users = Users();
    }
}

```
Upon making the initial Connection All Sql Statements Will be Accessible, it should also be noted it is not required to specify primary table name as this is done when the Model CLass is created

Users.php will connect to a table name called users, this means if you create a class called UserRoles a table called userroles will be required

###### Fetching Results (Select)
```php
  public function index()
    {
        $users = Users();
        $users->select()->get();
    }
```
###### Obtaining the First Record
```php
  public function index()
    {
        $users = Users();
        $users->select()->first();
    }
```
> to get more control over results it is also possible to use the save() method
> the Save method is the base method used in both get() and first().
> 
> By calling save() access to built in methods like fetchAll() fetch() and rowCount(), this gives more flexibility and freedom with the Querybuilder

###### Limiting Values within the select statments
it is possible to select specific column from the table by adding values into the select statement

```php
  public function index()
    {
        $users = Users();
        $users->select("username","email","password","firstname","lastname")->get();
    }
```
Leaving the select method empty will just call the wildcard (*) and select all values.

##### Using an alias
this would normally be used with joins but the query Builder also supports a table alias this is done using the as() method

```php

 public function insert()
    {
        $users = Users();
        $users->select("u.username")->as("u")->where("u.username","mrbean")->save();
    }
```


###### Inserting values
in order to insert data into the database the user is required to specify the values, this is done using our key pair magic method
```php
 public function insert()
    {
        $users = Users();
        $users->username = "mrbean";
        $users->password = password_hash("test",PASSWORD_DEFAULT);
        $users->insert()->save();
    }
```
> Retrieving the last id has currently not been implemented


###### Updating Data

Like Insert the update uses the key pair Magic method to pass data to the database
```php
 public function update()
    {
        $users = Users();
        $users->username = "mrbean";
        $users->password = password_hash("Apple12345",PASSWORD_DEFAULT);
        $users->insert()->where("id",1)->save();
    }
```

###### Deleting records
in order to delete a record the delete() method is required.
```php
 public function update()
    {
        $users = Users();
        $users->delete()->where("id",1)->save();
    }
```

> Please be aware you are required to add a where when using update and delete other wise you will affect all rows
For more information on Conditions [Click here](https://github.com/Lazarusphp/orm/tree/main/src/Traits/Conditions)



