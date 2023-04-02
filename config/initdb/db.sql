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
VALUES ('John Doe', 'johndoe@example.com', '$2y$10$dP8xW2AyJ7jjS9XjAST.aOV/XzAGh1Q8DENQe2Gi3b1KJ.thOXA6W', 'plant owner'), -- password123
	   ('Jane Smith', 'janesmith@example.com', '$2y$10$1A9zFecBBL7cNvnEzRzeK.ZWubL/g8a4OLVRu0lxw9ppTfqBjKuY6', 'plant waterer'), -- password456
	   ('Admin', 'admin@example.com', '$2y$10$gENKOnummoDOD7YDyXOSTeY1ybxVVLAtXR8ZI.De9BT0GAdhDoYWq', 'admin'); -- adminpassword

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
