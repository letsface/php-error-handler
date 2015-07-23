# php-error-handler
Exception handler for php to customise behavior given a specific exception code

## Usage

### Custom handler

```php
$handler = new \Letsface\ExceptionHandler();
$handler->listen('123', function() {
  return 'foo';
});

try {
  throw new \MyException('', '123');
}
catch(\Exception $e) {
  // will echo "foo";
  echo $handler->handle($e);
}
```

### Throw an exception
```php
$handler = new \Letsface\ExceptionHandler();
$handler->throws('123', '\AnotherException', 'My new message', 'NEWCODE');

try {
  throw new \MyException('', '123');
}
catch(\Exception $e) {
  // will throw "\AnotherException";
  $handler->handle($e);
}
```

### Rethrow the exception
```php
$handler = new \Letsface\ExceptionHandler();
$handler->rethrow('123');

try {
  throw new \MyException('', '123');
}
catch(\Exception $e) {
  // will throw $e;
  $handler->handle($e);
}
```
