LOAD DATA LOCAL INFILE 'gyms.dat' INTO TABLE Gyms 
FIELDS TERMINATED BY ','
(name, city, zipcode);
