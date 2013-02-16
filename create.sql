CREATE TABLE IF NOT EXISTS Users (
	userID INT PRIMARY KEY,
	username VARCHAR(50)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Gyms (
	gymID INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	city VARCHAR(100),
	zipcode INT
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Climbs (
	climbID INT AUTO_INCREMENT PRIMARY KEY,
	gymID INT NOT NULL,
	name VARCHAR(100) NOT NULL,
	difficulty INT NOT NULL,
	tapeColor VARCHAR(50),
	pictureURL VARCHAR(100),

	FOREIGN KEY (gymID) references Gyms(gymID)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Comments (
	commentID INT AUTO_INCREMENT PRIMARY KEY,
	climbID INT NOT NULL,
	comments VARCHAR(5000) NOT NULL,
	userID INT NOT NULL,

	FOREIGN KEY (climbID) references Climbs(climbID),
	//FOREIGN KEY (userID) references Users(userID)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS ChallengeStrings (
	challengeID INT AUTO_INCREMENT PRIMARY KEY,
	climbID INT NOT NULL,
	challenge VARCHAR(5000) NOT NULL,
	userID INT NOT NULL,

	FOREIGN KEY (climbID) references Climbs(climbID),
	//FOREIGN KEY (userID) references Users(userID)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS ChallengeVideos (
	videoID INT AUTO_INCREMENT PRIMARY KEY,
	challengeID INT NOT NULL,
	videoURL VARCHAR(5000) NOT NULL,
	userID INT,

	FOREIGN KEY (challengeID) references ChallengeStrings(challengeID),
	//FOREIGN KEY (userID) references Users(userID)

) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS BetaVideos (
	betaID INT AUTO_INCREMENT PRIMARY KEY,
	climbID INT NOT NULL,
	videoURL VARCHAR(100) NOT NULL,
	userID INT,
	dateAdded TIMESTAMP,
	rating INT,

	FOREIGN KEY (climbID) references Climbs(climbID),
	//FOREIGN KEY (userID) references Users(userID)
) ENGINE=INNODB;
