-- Create the users table
CREATE TABLE users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(20) NOT NULL
);

-- Insert sample data into the users table
INSERT INTO users (name, email, password, role)
VALUES ('John Doe', 'johndoe@example.com', 'password123', 'plant owner'),
	   ('Jane Smith', 'janesmith@example.com', 'password456', 'plant waterer'),
	   ('Admin', 'admin@example.com', 'adminpassword', 'admin');

-- Create the watering table
CREATE TABLE watering (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT(6) UNSIGNED NOT NULL,
	date DATE NOT NULL,
	time TIME NOT NULL,
	completed TINYINT(1) NOT NULL DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample data into the watering table
INSERT INTO watering (user_id, date, time, completed)
VALUES (1, '2023-04-02', '09:00:00', 0),
	   (1, '2023-04-04', '15:00:00', 0),
	   (2, '2023-04-03', '11:00:00', 0);
