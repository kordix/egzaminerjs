CREATE TABLE users(
    id int AUTO_INCREMENT,
    login varchar(255),
    password varchar(255),
    PRIMARY KEY (id)
    );


INSERT INTO `users` (`id`, `login`, `password`) VALUES (1, 'admin', '0192023a7bbd73250516f069df18b500');
