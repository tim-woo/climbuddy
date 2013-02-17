LOAD DATA LOCAL INFILE 'users.del' INTO TABLE Users 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '../gyms.del' INTO TABLE Gyms 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(name, city, zipcode);

LOAD DATA LOCAL INFILE 'climbs.del' INTO TABLE Climbs 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(gymID, name, difficulty, tapeColor, pictureURL);

LOAD DATA LOCAL INFILE 'comments.del' INTO TABLE Comments 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(climbID, comments, username);

LOAD DATA LOCAL INFILE 'challengeStrings.del' INTO TABLE ChallengeStrings 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(climbID, challenge, username);

LOAD DATA LOCAL INFILE 'challengeVideos.del' INTO TABLE ChallengeVideos 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(challengeID, videoURL, username);

LOAD DATA LOCAL INFILE 'betaVideos.del' INTO TABLE BetaVideos 
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
(climbID, videoURL, username, dateAdded, rating);

