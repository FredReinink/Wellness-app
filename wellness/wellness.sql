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


DROP TABLE IF EXISTS userWellnessTest;
CREATE TABLE userWellnessTest
(
	username varchar(225) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),  
    Age int NOT NULL,
    Height_cm varchar(225) NOT NULL,
    Weight_kg varchar(225) NOT NULL,
    BMI_calculated varchar(225) NOT NULL,
    Test_Date date NOT NULL,
    Sex varchar(225) NOT NULL,
    Waist_Size_inch varchar(225) NOT NULL,
    Waist_height_Ratio varchar(225) NOT NULL,
    W_H_Result varchar(225) NOT NULL,
    ActivityLevel varchar(225) NOT NULL,
    WeightGoal varchar(225) NOT NULL,
    calories_Intake varchar(225) NOT NULL,
    restingPulse varchar(225) NOT NULL,
    MaxHeartRate varchar(225) NOT NULL,
    TargetHRZone varchar(225) NOT NULL
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