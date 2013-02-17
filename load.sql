LOAD DATA LOCAL INFILE 'gyms.del' INTO TABLE Gyms 
FIELDS TERMINATED BY ','
(name, city, zipcode);
