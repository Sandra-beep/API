# API
ABOUT:
School project on how to use API with PHP, classes and functions. Information is directly written in the URL.

DATABASE
Carts - With one order from one user
Products - With all the products made
Users - All the users one have created

Code rules (I've tried to keep);

Class names
If it is a class, it starts with a big letter, ex:
class User

Methods/functions
If it a method/function in a class, I user big camelcase, ex:
CreateUser

Variables
In the cases that I create a variable, I use normally the same camelcase for variables as , ex:
$userID(variable in VS code) and userID(name of column in database)

Titles of php-files
The titles of the php-files in the project are written in small camelcase, ex:
getOneUser or getAll

ENDPOINTS:

Users:
UserClass.php
loginUser.php
getOneUser.php
deleteUser.php
editUser.php
getAll.php
createUser.php
Tokens
createToken.php
checkToken.php
validateToken.php
UpdateToken.php

Products:
productClass.php
createProduct.php
deleteProduct.php
getAllProducts.php
getOneProduct.php
editProduct.php
searchProduct.php

Cart:
cartClass.php
createCart.php
checkout.php
deleteProdFromCart.php

VALIDATIONS:
In most cases one need a userid to be validated to be able to create a cart for example.