<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


$container = SousedskaPomoc\Bootstrap::boot()
	->createContainer();

if (!isset($_SERVER['argv'][3])) {
	echo '
Add new user to database.

Usage: create-user.php <name> <email> <password>
';
	exit(1);
}

[, $name, $email, $password] = $_SERVER['argv'];

$manager = $container->getByType(SousedskaPomoc\Model\UserManager::class);

try {
	$manager->add($name, $email, $password);
	echo "User $name was added.\n";

} catch (SousedskaPomoc\Model\DuplicateNameException $e) {
	echo "Error: duplicate name.\n";
	exit(1);
}
