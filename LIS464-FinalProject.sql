use user30DB3;

CREATE TABLE Movies (
	MovieID 			int 			Not null,
	Title				char(100) 		not null,
	Overview			text(600) 	null, 
	Runtime 			smallint 		NULL,
    ReleaseYear         Year            null, 
    MovieLanguage		char(25)        null,
    Budget  			Decimal(5,2)    null,
    Gross				Decimal(5,2) 	null,
	CHECK (Runtime between 30 and 300),
    check (Budget > 0),
	PRIMARY KEY(MovieID)
	)ENGINE=INNODB;
    
CREATE TABLE Genre (
	GenreID 			int 			Not null,
	GenreName			char(25) 		not null,
	PRIMARY KEY(GenreID)
	)ENGINE=INNODB;
    
    CREATE TABLE Director (
	DirectorID          int 			Not null,
	DFirstName		    varchar(25) 	not null,
	DLastName			varchar(30) 	not  null, 
	DateofBirth 	    date 			NULL,
    Gender           	varchar(10) 	null,
    PRIMARY KEY(DirectorID)
	)ENGINE=INNODB;
    
    CREATE TABLE Actors (
	ActorID          int 			Not null,
	ActorFirstName		    varchar(25) 	not null,
	ActorLastName			varchar(30) 	not  null, 
    PRIMARY KEY(ActorID)
	)ENGINE=INNODB;

CREATE TABLE Characters (
	CharacterID          int 			Not null,
	CharacterName		 varchar(50) 	not null,
	MovieID				 int			not  null, 
    ActorID 			 int            not null,
    PRIMARY KEY(CharacterID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID),
    FOREIGN KEY (ActorID) REFERENCES Actors(ActorID)
	)ENGINE=INNODB;
    
    
 CREATE TABLE Company (
	CompanyID          int 			Not null,
	CompanyName		   varchar(50) 	not null, 
    PRIMARY KEY(CompanyID)
	)ENGINE=INNODB;  
    
CREATE TABLE MovieGenre (
	MovieGenreID          int 			Not null,
	GenreID		 		  int 			not null,
	MovieID				  int			not  null, 
    PRIMARY KEY(MovieGenreID),
    FOREIGN KEY (GenreID) REFERENCES Genre(GenreID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
	)ENGINE=INNODB;
    
CREATE TABLE DirectorMovie (
	DirectorMovieID         int 			Not null,
	DirectorID		 		int 			not null,
	MovieID				  	int				not null, 
    PRIMARY KEY(DirectorMovieID),
    FOREIGN KEY (DirectorID) REFERENCES Director(DirectorID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
	)ENGINE=INNODB;

CREATE TABLE CompanyMovie (
	CompanyMovieID         int 			Not null,
	CompanyID		 		int 			not null,
	MovieID				  	int				not null, 
    PRIMARY KEY(CompanyMovieID),
    FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID),
    FOREIGN KEY (MovieID) REFERENCES Movies(MovieID)
	)ENGINE=INNODB;
    
CREATE INDEX MovieInfo ON Movies (MovieID, Title, Runtime,MovieLanguage,Budget,Gross);
CREATE INDEX GenreInfo ON Genre (GenreID, GenreName);
CREATE INDEX DirectorInfo ON Director (DirectorID,DFirstName,DLastName);
CREATE INDEX ActorsInfo ON Actors (ActorID , ActorFirstName, ActorLastName);
CREATE INDEX CharactersInfo ON Characters (CharacterID , CharacterName, MovieID,ActorID);
CREATE INDEX CompanyInfo ON Company (CompanyID , CompanyName);
CREATE INDEX MovieGenreInfo ON MovieGenre (MovieGenreID, GenreID,MovieID);
CREATE INDEX CompanyMovieInfo ON CompanyMovie (CompanyMovieID , CompanyID, MovieID); 


CREATE VIEW ActorMovie AS 
SELECT ActorFirstName AS FirstName,
ActorLastName AS LastName,
CharacterName AS CharacterName,
Title as MovieTitle
FROM Actors, Movies,Characters
WHERE  Movies.MovieID = Characters.MovieID
AND Characters.ActorID = Actors.ActorID
Order by CharacterName desc
;
SELECT *FROM ActorMovie;

CREATE VIEW GenreMovie AS 
SELECT 
GenreName AS MovieType,
Title AS MovieTitle
FROM Genre, Movies,MovieGenre
WHERE  Movies.MovieID = MovieGenre.MovieID
AND MovieGenre.GenreID = Genre.GenreID
order by Title desc;
SELECT *FROM GenreMovie;


CREATE VIEW CompanyMoney AS 
SELECT 
Company.CompanyID as CompanyID,
CompanyName AS Company,
AVG(Gross) AS AvgGross
FROM Company, Movies,CompanyMovie
WHERE  Movies.MovieID = CompanyMovie.MovieID
AND CompanyMovie.CompanyID = Company.CompanyID
Group by CompanyName 
order by AVG(Gross) desc;
SELECT *FROM CompanyMoney;

CREATE VIEW GenreMoney AS 
SELECT 
GenreName AS MovieType,
Avg(Gross) AS AvgGross
FROM Genre, Movies,MovieGenre
WHERE  Movies.MovieID = MovieGenre.MovieID
AND MovieGenre.GenreID = Genre.GenreID
Group by GenreName 
order by Avg(Gross) desc;
SELECT *FROM GenreMoney;

CREATE VIEW GenreCompany AS 
SELECT 
GenreName AS MovieType,
Title AS MovieName,
CompanyName as Company
FROM Genre, Movies,MovieGenre, Company, CompanyMovie
WHERE  Movies.MovieID = MovieGenre.MovieID
AND MovieGenre.GenreID = Genre.GenreID
AND Movies.MovieID = CompanyMovie.MovieID
AND CompanyMovie.CompanyID = Company.CompanyID;
SELECT *FROM GenreCompany;