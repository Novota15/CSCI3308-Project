

DROP TABLE IF EXISTS nwUsers;
CREATE TABLE nwUsers 
   (
   id             SERIAL PRIMARY KEY,
   UserName       varchar(40)  NOT NULL ,
   fullName       varchar(40)  NOT NULL ,
   Password       varchar(60)  NULL ,
   Email          varchar(60)  NULL ,
   Address        varchar(60)  NULL ,
   City           varchar(15)  NULL ,
   Region         varchar(15)  NULL ,
   PostalCode     varchar(10)  NULL ,
   Country        varchar(15)  NULL ,
   Phone          varchar(24)  NULL 
   );

INSERT INTO nwUsers (UserName, fullName, Password, Email, Address, City, Region, PostalCode, Country,Phone) Values
 ('arwasait','Arwa Mohammed', 'blahblahblah','armo7391@colorado.edu','2950 Bixby Lane','Boulder','Colorado','80303','USA','4055109128'),

('haal2311','Hassan Aljishi', 'blahblahblah','haal2311@colorado.edu','2955 college ave','Boulder','Colorado','80303','USA','3034759986'),

 ('alal7205','Ali Al naji', 'blahblahblah','alal7205@colorado.edu','2870 East College','Boulder','Colorado','80303','USA','3034757462'),

 ('grantnovota','Grant Novota', 'blahblahblah','grno9650@colorado.edu','1234 Colorado Lane','Boulder','Colorado','80303','USA','43035109128'),

('jameswells','James Wells','password12','jameswellsiv@gmail.com','4813 Little Bear Place','Broomfield','Colorado','80023','USA','7208991353');



DROP TABLE IF EXISTS nasdaq_data;
CREATE TABLE nasdaq_data
   (
   Symbol        varchar(100)  NOT NULL ,
   Name          varchar(100)  NOT NULL ,
   LastSale      decimal(7,2)  NULL ,
   MarketCap      decimal(64,2)  NULL ,
   ADR_TSO        varchar(60)  NULL ,
   IPOyear        varchar(15)  NULL ,
   Sector        varchar(40)  NULL ,
   Industry       varchar(100)  NULL ,
   Summary_Quote   varchar(70)  NULL 
   );


   COPY nasdaq_data FROM '/Users/arwasadiq/Desktop/Milestone 3/nasdaq.csv' HEADER CSV  DELIMITER ',';


   DROP TABLE IF EXISTS nyse_data;
CREATE TABLE nyse_data
   (
   Symbol        varchar(100)  NOT NULL ,
   Name          varchar(100)  NOT NULL ,
   LastSale      decimal(7,2)  NULL ,
   MarketCap      decimal(64,2)  NULL ,
   ADR_TSO        varchar(60)  NULL ,
   IPOyear        varchar(15)  NULL ,
   Sector        varchar(40)  NULL ,
   Industry       varchar(100)  NULL ,
   Summary_Quote   varchar(70)  NULL 
   );
 

   COPY nyse_data FROM '/Users/arwasadiq/Desktop/Milestone 3/nyse.csv' HEADER CSV  DELIMITER ',';