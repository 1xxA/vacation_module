CREATE TABLE IF NOT EXISTS users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20) NOT NULL,
	vacation_days int NOT NULL
);

INSERT INTO users (name, vacation_days)
VALUES ('Phillip', 20),
		('Andrew', 12),
		('Diana', 15);
		
CREATE TABLE IF NOT EXISTS pending_vacation_requests (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	date_start DATE NOT NULL,
	date_end DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS approved_vacation_requests (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	date_start DATE NOT NULL,
	date_end DATE NOT NULL
);



