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
INSERT INTO users (username, email, password, first_name, last_name) VALUES ("Natasha_BornToTrumpet", "natasha@gmail.com", "6F5393979D674DE36C433B47B7D8908E", "Natasha","Born");
INSERT INTO users (username, email, password, first_name, last_name) VALUES ("Claire_Bear", "claire@gmail.com", "6F5393979D674DE36C433B47B7D8908E", "Claire","Delany");
INSERT INTO users (username, email, password, first_name, last_name) VALUES ("Steven_Swag", "steven@gmail.com", "6F5393979D674DE36C433B47B7D8908E", "Steven","Taylor");
INSERT INTO users (username, email, password, first_name, last_name) VALUES ("Pankti_coolBean", "pankti@gmail.com", "6F5393979D674DE36C433B47B7D8908E", "Pankti","Shah");
INSERT INTO users (username, email, password, first_name, last_name) VALUES ("Frank", "frank@gmail.com", "912ec803b2ce49e4a541068d495ab570", "Frank","Guy");



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

INSERT INTO articles (ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4) VALUES ("Diet Plans for Obese People", "KELSEY CASSELBURY", "https://www.livestrong.com/article/304859-diet-plans-for-obese-people/", "obese", "food", "diet plan", "healthy", "eating", "lose weight", "null"); 
INSERT INTO articles (ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4) VALUES ("Exercise for Obese People", "Shirley Armstrong", "https://www.healthline.com/health/fitness-exercise/exercise-for-obese-people#4", "obese", "exercise", "fitness plan", "healthy", "fit", "lose weight", "null"); 
INSERT INTO articles (ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4) VALUES ("10 Exercise to keep you healthy and fit", "Tom MacMurry", "https://www.daimanuel.com/2014/03/02/top-10-best-exercises-to-keep-you-healthy-and-fit/", "fitness", "food", "exercise", "healthy", "stay fit", "lose weight", "null"); 
INSERT INTO articles (ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4) VALUES ("Hike it Out", "Siobhan Harmer", "https://www.lifehack.org/articles/lifestyle/30-the-worlds-most-breathtaking-hiking-trails-you-must-visit.html", "fitness", "hike", "fit", "obese", "wellness", "lose weight", "null"); 


DROP TABLE IF EXISTS listOfChallenges;
CREATE TABLE listOfChallenges
(
    challenge_name varchar(225) NOT NULL PRIMARY KEY,
    challenge_description varchar(225) NOT NULL, 
    points_submission varchar(225) NOT NULL
);
INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission) VALUES ("Running 10 km", "Run 10 km five times a month", "15");
INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission) VALUES ("Swimming 15 km", "Swim 15 km twice this month", "15");
INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission) VALUES ("Take a hike", "Take a hike and let us know where you went!", "10");
INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission) VALUES ("Bike to work", "Bike to work 5 times a month", "25");



DROP TABLE IF EXISTS challenges;
CREATE TABLE challenges
(
    username varchar(225) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),
    challenge_name varchar(255) NOT NULL,
    FOREIGN KEY (challenge_name) REFERENCES listOfChallenges(challenge_name), 
    submission text NOT NULL,
    points_granted varchar(225) NOT NULL
);


DROP TABLE IF EXISTS userPoints;
CREATE TABLE userPoints
(
    username varchar(225) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),
    points varchar(225)
);
INSERT INTO userPoints (username, points) VALUES ("Natasha_BornToTrumpet", 250);
INSERT INTO userPoints (username, points) VALUES ("Claire_Bear", 50);
INSERT INTO userPoints (username, points) VALUES ("Steven_Swag", 100);
INSERT INTO userPoints (username, points) VALUES ("Pankti_coolBean", 45);
INSERT INTO userPoints (username, points) VALUES ("admin101", 17);


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
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("White bread", "Slice", "79", "2.7", "1", "15");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Eggs", "One egg", "78", "6", "5", "0.6");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Milk", "Cup", "103", "8", "2.4", "12");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Bacon", "Slice", "43", "3", "3.3", "0.1");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Whole wheat bread", "Slice", "69", "3.6", "0.9", "12");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Tomato", "100g", "18", "0.9", "0.2", "3.9");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Potato", "100g", "77", "2", "0.1", "17");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Apple", "One apple(95g)", "95", "0.5", "0.3", "25");
INSERT INTO foodItem (name, quantity, calories, gProtein, gFat, gCarbs) VALUES ("Banana", "Banana (118g)", "105", "1.3", "0.4", "27");


DROP TABLE IF EXISTS dietTracker;
CREATE TABLE dietTracker
(
	username varchar(255) NOT NULL,
	diet_date date NOT NULL,
	calories_consumed int DEFAULT 0,
	weight int,
	gProteinConsumed int DEFAULT 0,
	gCarbsConsumed int DEFAULT 0,
	gFatConsumed int DEFAULT 0,
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY(username, diet_date)
);

INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-02", "2000", "96", "92", "122", "36");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-04", "2300", "93", "103", "107", "29");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-06", "1977", "95", "77", "155", "27");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-10", "1700", "95", "90", "122", "42");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-12", "1888", "94", "66", "150", "39");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-14", "2300", "92", "90", "88", "57");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-18", "1987", "94", "99", "120", "40");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-20", "1866", "93", "88", "120", "29");
INSERT INTO dietTracker(username, diet_date, calories_consumed, weight, gProteinConsumed, gCarbsConsumed, gFatConsumed) VALUES ("Frank", "2019-06-24", "1923", "91", "103", "122", "29");


DROP TABLE IF EXISTS cardioTracker;
CREATE TABLE cardioTracker
(
 	username varchar(255) NOT NULL,
	cardio_date date NOT NULL,
	cardio_minutes int,
	cardio_heartrate int,
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY(username, cardio_date)
);

INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-02", "30", "90");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-04", "30", "92");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-05", "35", "90");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-06", "30", "90");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-08", "35", "96");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-09", "36", "96");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-10", "37", "97");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-12", "35", "95");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-14", "33", "94");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-16", "30", "100");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-18", "29", "102");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-20", "35", "99");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-22", "37", "102");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-24", "40", "105");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-25", "44", "100");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-26", "40", "102");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-28", "38", "103");
INSERT INTO cardioTracker(username, cardio_date, cardio_minutes, cardio_heartrate) VALUES ("Frank", "2019-06-30", "42", "105");




DROP TABLE IF EXISTS followedExercises;
CREATE TABLE followedExercises
(
	username varchar(255) NOT NULL,

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

INSERT INTO followedExercises(username, user_exercise1_name, user_exercise2_name, user_exercise3_name) VALUES ("Frank", "Standing Press", "Squat", "Bench Press");
INSERT INTO followedExercises(username) VALUES ("Pankti_coolBean");
INSERT INTO followedExercises(username) VALUES ("Steven_Swag");
INSERT INTO followedExercises(username) VALUES ("Claire_Bear");
INSERT INTO followedExercises(username) VALUES ("Natasha_BornToTrumpet");
INSERT INTO followedExercises(username) VALUES ("admin101");


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
	
	
	FOREIGN KEY (username) REFERENCES users(username),
	PRIMARY KEY(username, weights_date)
);

INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-01", "Standing Press", "40", "25", "Squat", "95", "25", "Bench Press", "70", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-03", "Standing Press", "40", "25", "Squat", "100", "25", "Bench Press", "75", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-06", "Standing Press", "45", "25", "Squat", "105", "25", "Bench Press", "75", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-10", "Standing Press", "45", "25", "Squat", "110", "25", "Bench Press", "80", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-15", "Standing Press", "50", "25", "Squat", "115", "25", "Bench Press", "80", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-18", "Standing Press", "55", "25", "Squat", "115", "25", "Bench Press", "85", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-22", "Standing Press", "55", "25", "Squat", "120", "25", "Bench Press", "90", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-26", "Standing Press", "60", "25", "Squat", "125", "25", "Bench Press", "90", "25");
INSERT INTO weightLiftingTracker(username, weights_date, user_exercise1_name, user_exercise1_weight, user_exercise1_reps, user_exercise2_name, user_exercise2_weight, user_exercise2_reps, user_exercise3_name, user_exercise3_weight, user_exercise3_reps) VALUES ("Frank", "2019-06-30", "Standing Press", "60", "25", "Squat", "130", "25", "Bench Press", "95", "25");


DROP TABLE IF EXISTS feedBack;
CREATE TABLE feedBack
(
	name varchar(255) NOT NULL,
	fromEmail varchar(255) NOT NULL,
	subject varchar(255) NOT NULL,
	message text NOT NULL
);