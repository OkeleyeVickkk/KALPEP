CREATE TABLE users_account_dump (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL UNIQUE,
    first_name phone VARCHAR(20) NULL,
    last_name phone VARCHAR(20) NULL,
    nin VARCHAR(20) NOT NULL UNIQUE,
    bvn VARCHAR(20) NOT NULL UNIQUE,
    state VARCHAR(20)  NULL,
    virtual_account_no VARCHAR(20) NOT NULL UNIQUE,
    virtaul_account_name VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);