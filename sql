CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255) DEFAULT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

ALTER TABLE users ADD username VARCHAR(50) UNIQUE NOT NULL AFTER id;

INSERT INTO users (username, first_name, last_name, email, password, created, modified)
VALUES ('theodefossez', 'Theo', 'Defossez', 'theo.defossez14@gmail.com', 'theolea1', NOW(), NOW());


CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ordre INT NOT NULL,
    intitule VARCHAR(255) NOT NULL,
    lien VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO menus (ordre, intitule, lien) VALUES
(1, 'Utilisateurs', '/users/index'),
(2, 'Menu', '/menus/index');


CREATE TABLE sleep_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    bedtime TIME NOT NULL,
    wake_time TIME NOT NULL,
    naps ENUM('none', 'afternoon', 'evening', 'both') DEFAULT 'none',
    wake_score TINYINT CHECK(wake_score BETWEEN 0 AND 10),
    comment TEXT,
    sport_done BOOLEAN DEFAULT FALSE,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO menus (ordre, intitule, lien, created, modified)
VALUES (1, 'Dashboard', '/dashboard', NOW(), NOW());

INSERT INTO menus (ordre, intitule, lien, created, modified)
VALUES (2, 'Sleep Logs', '/sleep-logs', NOW(), NOW());
