CREATE DATABASE wellness;
USE wellness;


DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    username varchar(225) NOT NULL PRIMARY KEY,
    email   varchar(225) NOT NULL UNIQUE,
    password varchar(225) NOT NULL, 
    first_name varchar(225) NOT NULL,
    last_name varchar(225) NOT NULL
);

INSERT INTO users (username, email, password, first_name, last_name) VALUES ("admin101", "admin@well.com", "6F5393979D674DE36C433B47B7D8908E", "admin","admin");

DROP TABLE IF EXISTS userWellnessTest;
CREATE TABLE userWellnessTest
(
	testID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username varchar(225) NOT NULL,
    Age int NOT NULL,
    Height_cm varchar(225) NOT NULL,
    Weight_kg varchar(225) NOT NULL,
    BMI_calculated varchar(225) NOT NULL,
    Test_Date date NOT NULL,
    Sex varchar(225) NOT NULL,
    ActivityLevel varchar(225) NOT NULL,
    WeightGoal varchar(225) NOT NULL,
    restingPulse varchar(225) NOT NULL,
    MaxHeartRate varchar(225) NOT NULL	
);



DROP TABLE IF EXISTS articles;
CREATE TABLE articles
(
    article_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ArticleTitle varchar(255) NOT NULL,
    ArticleAuthors varchar(255) NOT NULL,
    urls varchar(225) NOT NULL UNIQUE,
    ArticleTopic_1 varchar(225),
    ArticleTopic_2 varchar(225),
    ArticleTopic_3 varchar(225),
    ArticleTag_1 varchar(225),
    ArticleTag_2 varchar(225),
    ArticleTag_3 varchar(225),
    ArticleTag_4 varchar(225)
);


DROP TABLE IF EXISTS listOfChallenges;
CREATE TABLE listOfChallenges
(
    challenge_name varchar(225) NOT NULL PRIMARY KEY,
    challenge_description varchar(225) NOT NULL, 
    points_submission int NOT NULL
);


DROP TABLE IF EXISTS challenges;
CREATE TABLE challenges
(
    username varchar(225) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),
    challenge_name varchar(255) NOT NULL,
    FOREIGN KEY (challenge_name) REFERENCES listOfChallenges(challenge_name), 
    submission text NOT NULL,
    points_granted int NOT NULL
);


DROP TABLE IF EXISTS userPoints;
CREATE TABLE userPoints
(
    username varchar(225) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),
    points int
);

DROP TABLE IF EXISTS foodItem;
CREATE TABLE foodItem
(
	name varchar(225) NOT NULL,
	quantity varchar(225) NOT NULL,
	calories int NOT NULL,
	gProtein int NOT NULL,
	gFat int NOT NULL,
	gCarbs int NOT NULL,
	
	PRIMARY KEY(name)
);
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("White bread", "Slice", "24", "0.8", "0.3", "4.4");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Eggs", "One egg", "78", "6", "5", "0.6");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Milk", "Cup", "103", "8", "2.4", "12");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Bacon", "Slice", "43", "3", "3.3", "0.1");



DROP TABLE IF EXISTS dietTracker;
CREATE TABLE dietTracker
(
	username varchar(255) NOT NULL,
	diet_date date NOT NULL,
	calories_consumed int,
	weight int,
	gProteinConsumed int,
	gCarbsConsumed int,
	gFatConsumed int,
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY(username, diet_date)
);

DROP TABLE IF EXISTS fitnessTracker;
CREATE TABLE fitnessTracker
(
	username varchar(255) NOT NULL,
	fitness_date date NOT NULL,
	exercise_hours int,
	sleep_hours int,
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY(username, fitness_date)
);

DROP TABLE IF EXISTS cardioTracker;
CREATE TABLE cardioTracker
(
 	username varchar(255) NOT NULL,
	cardio_date date NOT NULL,
	cardio_minutes int,
	cardio_heartrate int,
	
	FOREIGN KEY (username) REFERENCES fitnessTracker(username),
	PRIMARY KEY(username, cardio_date)

);

DROP TABLE IF EXISTS followedExercises;
CREATE TABLE followedExercises
(
	username varchar(255) NOT NULL,
	num_exercises int DEFAULT 0 NOT NULL,

	user_exercise1_name varchar(255),
	user_exercise2_name varchar(255),
	user_exercise3_name varchar(255),
	user_exercise4_name varchar(255),
	user_exercise5_name varchar(255),
	user_exercise6_name varchar(255),
	user_exercise7_name varchar(255),
	user_exercise8_name varchar(255),
	user_exercise9_name varchar(255),
	user_exercise10_name varchar(255),
	user_exercise11_name varchar(255),
	user_exercise12_name varchar(255),
	user_exercise13_name varchar(255),
	user_exercise14_name varchar(255),
	user_exercise15_name varchar(255),
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY (username)
);

DROP TABLE IF EXISTS weightLiftingTracker;
CREATE TABLE weightLiftingTracker
(
	username varchar(255) NOT NULL,
	weights_date date NOT NULL,
	
	user_exercise1_name varchar(255),
	user_exercise1_weight int,
	user_exercise1_reps int,
	
	user_exercise2_name varchar(255),
	user_exercise2_weight int,
	user_exercise2_reps int,
	
	user_exercise3_name varchar(255),
	user_exercise3_weight int,
	user_exercise3_reps int,
	
	user_exercise4_name varchar(255),
	user_exercise4_weight int,
	user_exercise4_reps int,
	
	user_exercise5_name varchar(255),
	user_exercise5_weight int,
	user_exercise5_reps int,
	
	user_exercise6_name varchar(255),
	user_exercise6_weight int,
	user_exercise6_reps int,
	
	user_exercise7_name varchar(255),
	user_exercise7_weight int,
	user_exercise7_reps int,
	
	user_exercise8_name varchar(255),
	user_exercise8_weight int,
	user_exercise8_reps int,
	
	user_exercise9_name varchar(255),
	user_exercise9_weight int,
	user_exercise9_reps int,
	
	user_exercise10_name varchar(255),
	user_exercise10_weight int,
	user_exercise10_reps int,
	
	user_exercise11_name varchar(255),
	user_exercise11_weight int,
	user_exercise11_reps int,
	
	user_exercise12_name varchar(255),
	user_exercise12_weight int,
	user_exercise12_reps int,
	
	user_exercise13_name varchar(255),
	user_exercise13_weight int,
	user_exercise13_reps int,

	user_exercise14_name varchar(255),
	user_exercise14_weight int,
	user_exercise14_reps int,
	
	user_exercise15_name varchar(255),
	user_exercise15_weight int,
	user_exercise15_reps int,
	
	
	FOREIGN KEY (username) REFERENCES fitnessTracker(username),
	PRIMARY KEY(username, weights_date)

	
);


DROP TABLE IF EXISTS feedBack;
CREATE TABLE feedBack
(
	name varchar(255) NOT NULL,
	fromEmail varchar(255) NOT NULL,
	subject varchar(255) NOT NULL,
	message text NOT NULL
);