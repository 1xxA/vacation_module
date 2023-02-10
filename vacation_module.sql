CREATE TABLE IF NOT EXISTS users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20) NOT NULL,
	vacation_days int NOT NULL
);

INSERT INTO users (name, vacation_days)
VALUES ('Phillip', 20),
		('Andrew', 12),
		('Diana', 15);



