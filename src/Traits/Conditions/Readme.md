# Using Conditional Statements
As Part of the query Builder Conditional statements have be implemented giving he code more flexibility when handing data.

###### Where
Adding a where statement to the structure will allow the to specific record, as shown below we will look for a user with the id of 1

```php
  public function index()
    {
        $users = Users();
        $users->select()->where("id","1")->first();
    }
```
###### and where
if one or more where conditions are required it can be done by adding a second where method to the query, adding a second where method will add the AND statement in automatically
```php
  public function index()
    {
        $users = Users();
        $users->select()->where("id","1")->where("username","mrbean")->first();
    }
```
this would output
```sql
    SELECT * FROM users WHERE id='1' AND username = "mrbean";
```

###### orwhere
Like where the option for or is also made available by using the orWhere() method

```php
  public function index()
    {
        $users = Users();
        $users->select()->where("id","1")->orWhere("username","mrbean")->first();
    }
```
this would output
```sql
    SELECT * FROM users WHERE id='1' OR username = "mrbean";
```

### using joins
using Joins allows a table to merge with one or more tables combining the records into one this can be done using either 
inner left right or cross joins.

```php
  public function index()
    {
        $users = Users();
        $users->select()->innerJoin("profiles")->on("users.id","profile.user_id")->where("id","1")->first();
    }
```
```sql
    SELECT * FROM users INNER JOIN profiles ON user.id = profile.user_id WHERE id='1'
```
by adding aliases to the tables and adding values to select will limit the data you will can recieve
this would output

```php
  public function index()
    {
        $users = Users();
        $users->select("u.username","p.firstname","u.id","p.user_id")->as("u")->innerJoin("profiles","p")->on("u.id","p.user_id")->where("u.id","1")->first();
    }
```
```sql
    SELECT u.username, p.firstname, u.id, p.user_id FROM users u INNER JOIN profiles p ON u.id = p.user_id WHERE u.id='1'
```
the same practice works for leftJoin() rightJoin() and crossJoin()

###### Having
Having allows the ability to set aggregates against a current table this includes min max count and avg this can be accomplished by doing the following
```php
  public function index()
    {
        $users = Users();
        $users->select()->where("username","mrbean")->groupBy("id")->having("COUNT(id)",5,"<")->orderBy("ASC","id")->first();
    }
```
```sql
    SELECT u.username, p.firstname, u.id, p.user_id FROM users WHERE username = mrbean GROUP BY id having COUNT(id) < 5 ORDER BY id ASC;
```
###### Order BY
as shown above the Querybuilder supports  Ordering in both Ascending and Descending order this is done using the orderBy() method 
Please note it is required that the direction goes first and then the values as the Orderby supports Multiple values;

```php
  public function index()
    {
        $users = Users();
        $users->select()->orderBy("ASC","id")->first();
    }
```
```sql
    SELECT * FROM  users ORDER BY id ASC;
```

###### Group BY
Like Order by the Groupby has the ability to organise results and group them, do note that any duplicate records will not be displayed
the can be done with the following code.
```php
  public function index()
    {
        $users = Users();
        $users->select()->groupBy(id")->first();
    }
```
```sql
    SELECT * FROM  users WHERE id > 1 GROUP BY id ASC;
```

> Although the outputs here are shown in plain text the Query Builder uses named params and to prevent duplicate each param is given a prefix and an id.
> an example output is like so.

```sql
SELECT * FROM users u WHERE id>:where_66dded1fc62d5 GROUP BY username ORDER BY id ASC
```