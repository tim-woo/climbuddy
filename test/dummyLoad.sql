LOAD DATA LOCAL INFILE '../gyms.dat' INTO TABLE Gyms 
FIELDS TERMINATED BY ','
(name, city, zipcode);

LOAD DATA LOCAL INFILE 'climbs.dat' INTO TABLE Climbs 
FIELDS TERMINATED BY ','
(gymID, name, difficulty, tapeColor, pictureURL);

LOAD DATA LOCAL INFILE 'comments.dat' INTO TABLE Comments 
FIELDS TERMINATED BY ','
(climbID, comments, userID);

LOAD DATA LOCAL INFILE 'challengeStrings.dat' INTO TABLE ChallengeStrings 
FIELDS TERMINATED BY ','
(climbID, challenge, userID);

LOAD DATA LOCAL INFILE 'challengeVideos.dat' INTO TABLE ChallengeVideos 
FIELDS TERMINATED BY ','
(challengeID, videoURL, userID);

LOAD DATA LOCAL INFILE 'betaVideos.dat' INTO TABLE BetaVideos 
FIELDS TERMINATED BY ','
(climbID, videoURL, userID, dateAdded, rating);

LOAD DATA LOCAL INFILE 'user.dat' INTO TABLE BetaVideos 
FIELDS TERMINATED BY ','
(userID, username);