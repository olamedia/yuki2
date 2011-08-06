registry
========

$registry = new registry();
$registry->load(array('name'=>'value'));
$array = $registry->toArray();

Acting as array: $registry['name']
==========
$registry['name'] = 'value2';
echo $registry['name']; // 'value2'
isset($registry['name']);
unset($registry['name']);

Acting as object: $registry->name
==========
$registry->name = 'value3';
echo $registry->name; // 'value3'
isset($registry->name);
unset($registry->name);

Iterating
==========
foreach ($registry as $name => $value){
}

Appending
==========
$registry->name = 'Hello';
$registry->append('name', ' World!');
echo $registry->name; // 'Hello World!'

Push
=========
$registry->push('name', 'value');
$registry->push('name', 'value2');
$registry->push('name', 'value'); // will overwrite
var_dump($registry['name']); // array('value'=>'value', 'value2'=>'value2');

Callbacks
=========
$registry->foo = function($arg){
    return $arg;
};
echo $registry->call('foo', 'hello'); // 'hello'

Caching results
=========
$registry->foo = function($arg){
    return $arg;
};
$registry->callResult('foo', 'test');
echo $registry->callResult('foo', 'test2'); // 'test'

