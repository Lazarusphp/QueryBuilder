> Along with readne documentation the ORM is currently a work in progress script and has no official Release.

# Lazarus Php Orm

The Lazaraus Orm is a Model level Object relational Manager, this script also relies on the Lazarusphp Database Manager script

## Creating a Model Page
In order to connect to a table, it is required to Create a model, this is beccause the Script Generated the lowercase Table name based on the called class.

```
<?php
namespace App\Http\Models;

class Users extends Model
{

}
```


As long as the class is connected to the model the file doesnt haave anything inside it.

## Generating the table name
```
use App\Http\Models\Users;

$users = new Users();
```

By calling a new Instance of $users this will tell the Orm that the table name is called users

The code above 
