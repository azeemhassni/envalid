# Envalid  

**This is a fork of azi/envalid, originally authored by @azeemhassni.**  

**Envalid** is a framework agnostic and fluent server side form validation package for PHP  

- [Documentation](http://envalid.azeemhassni.com/docs.html)

# Installation
Envalid can be installed via `composer` just execute the following command
in your project root

```composer require wesleydeveloper/envalid```


# Usage
Using envalid in your project is super simple, here is an example
```php
$validator = new azi\Validator();
$validator->validate($_POST, [
    'username'         => 'required',
    'password'         => 'required|password:strong',
    'confirm_password' => 'required|same:password'
]);
```
If you've files to validate you will need to merge `$_POST|$_GET` and with `$_FILES` just like the following
```php
$validator = new azi\Validator();
$validator->validate(array_merge($_POST, $_FILES), [
    'profile_picture' => 'file:image'
]);
```

# Available Rules
- required
- email 
- password `Accepts password strength like password:strong|medium|normal (default noraml)` 
- number
- file `Accepts file type currently supported formats: image,video,doc`
- min
- max
- length
- array
- boolean
- ip
- same
- alpha
- alnum
- cpf_cnpj
- cep
- phone `Only BR phone numbers are supported`
- uf

# Contributions
This repository is maintained by 
[@azeemhassni](https://github.com/azeemhassni)
[@wesleydeveloper](https://github.com/wesleydeveloper)
 
 If you can contribute I'd love to merge your PR and your name will be mentioned 
 in the release notes and contributors list.
 
