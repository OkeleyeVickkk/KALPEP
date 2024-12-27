CREATE TABLE project_manager (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    lga VARCHAR(255) NOT NULL,
    town VARCHAR(255) NOT NULL,
    project_director  NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (project_director) REFERENCES project_director(id) 
);