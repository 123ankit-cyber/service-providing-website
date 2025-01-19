CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    contact_number VARCHAR(15),
    service_type VARCHAR(100),
    location VARCHAR(100),
    service_description TEXT,
    preferred_contact VARCHAR(10),
    preferred_time DATETIME
);
