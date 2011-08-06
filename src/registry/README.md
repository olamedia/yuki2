registry
========

```php
<?php
$registry = new registry();
$registry->load(array('name'=>'value'));
$array = $registry->toArray();
```

Acting as array: $registry['name']
---------
```php
<?php
$registry['name'] = 'value2';
echo $registry['name']; // 'value2'
isset($registry['name']);
unset($registry['name']);
```

Acting as object: $registry->name
---------
```php
<?php
$registry->name = 'value3';
echo $registry->name; // 'value3'
isset($registry->name);
unset($registry->name);
```

Iterating
---------
```php
<?php
foreach ($registry as $name => $value){
}
```

Appending
---------
```php
<?php
$registry->name = 'Hello';
$registry->append('name', ' World!');
echo $registry->name; // 'Hello World!'
```

Push
---------
```php
<?php
$registry->push('name', 'value');
$registry->push('name', 'value2');
$registry->push('name', 'value'); // will overwrite
var_dump($registry['name']); // array('value'=>'value', 'value2'=>'value2');
```

Callbacks
---------
```php
<?php
$registry->foo = function($arg){
    return $arg;
};
echo $registry->call('foo', 'hello'); // 'hello'
```

Caching results
---------
```php
<?php
$registry->foo = function($arg){
    return $arg;
};
$registry->callResult('foo', 'test');
echo $registry->callResult('foo', 'test2'); // 'test'
```

