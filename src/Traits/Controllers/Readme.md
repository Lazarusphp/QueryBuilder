# Sql Statements Usage

## Select Method
The select method has the Ability to pull records from the Database using the following methodss

Loading specific datta into the select method can be done by adding Quotes followed by a comma.
```
  $users = new users();
  $user = $users->select("username","email","password")->save();

  foreach($user->fetchAll() as $user)
{
  echo $user->username;
}
```

By leaving the select Method empty it will load all Values represented by *;
