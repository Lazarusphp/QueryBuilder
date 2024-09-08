# How to use Custom Classes.
as explained in the readme the query builder also supports adding your custom code without the need to edit the Querybuilders codebase

###### Findbyid
Although this feature is avaialble within the base code it will be used as an example for this guide and will also be using the class Users.php
```php
    public function findbyid($id)
    {
        return $this->where("id",$id);
    }
```
as shown in the example the code returns $this instead of users this is because Users.php extends the Model and Orm Directly and doesnt need to be instantiated
in the controller you would simply call

```php
    public function index()
    {
        $id = 1;
        $users = new Users();
        $users->select()->findbyid($id)->save();
    }
```
please be aware that this code will be created by a user and may break the query builder when called, simply revert the code back if problems persisit.
