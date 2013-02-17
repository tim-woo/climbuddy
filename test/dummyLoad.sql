LOAD DATA LOCAL INFILE 'users.dat' INTO TABLE Users 
FIELDS TERMINATED BY ',' ENCLOSED BY '"';

LOAD DATA LOCAL INFILE '../gyms.dat' INTO TABLE Gyms 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(name, city, zipcode);

LOAD DATA LOCAL INFILE 'climbs.dat' INTO TABLE Climbs 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(gymID, name, difficulty, tapeColor, pictureURL);

LOAD DATA LOCAL INFILE 'comments.dat' INTO TABLE Comments 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(climbID, comments, username);

LOAD DATA LOCAL INFILE 'challengeStrings.dat' INTO TABLE ChallengeStrings 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(climbID, challenge, username);

LOAD DATA LOCAL INFILE 'challengeVideos.dat' INTO TABLE ChallengeVideos 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(challengeID, videoURL, username);

LOAD DATA LOCAL INFILE 'betaVideos.dat' INTO TABLE BetaVideos 
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
(climbID, videoURL, username, dateAdded, rating);

