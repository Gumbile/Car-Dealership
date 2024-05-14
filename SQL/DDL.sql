CREATE SCHEMA car_dealership;
CREATE TABLE Locations (
    LocationID INT AUTO_INCREMENT PRIMARY KEY,
    LocationName VARCHAR(255) NOT NULL,
    Country VARCHAR(100) NOT NULL,
    City VARCHAR(100) NOT NULL
);
CREATE TABLE Cars (
     CarID   INT AUTO_INCREMENT PRIMARY KEY,
    Model VARCHAR(255) NOT NULL,
    Year_ INT NOT NULL,
    PlateID VARCHAR(50) UNIQUE NOT NULL,
    Status_ VARCHAR(50) NOT NULL,
    BaseRate DECIMAL(10, 2) NOT NULL,
    LocationID INT,
    FOREIGN KEY (LocationID) REFERENCES Locations(LocationID)
);

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Username VARCHAR(20) UNIQUE NOT NULL,
    `Password` VARCHAR(255) NOT NULL,
    Role_ VARCHAR(20) DEFAULT 'User'
);

CREATE TABLE Reservations (
    ReservationID INT AUTO_INCREMENT PRIMARY KEY,
    CarID INT NOT NULL,
    UserID INT NOT NULL,
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    PickupLocationID INT NOT NULL,
    DropOffLocationID INT NOT NULL,
    Status_ VARCHAR(50) NOT NULL,
    FOREIGN KEY (CarID) REFERENCES Cars(CarID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (PickupLocationID) REFERENCES Locations(LocationID),
    FOREIGN KEY (DropOffLocationID) REFERENCES Locations(LocationID)
);

CREATE TABLE Payments (
    PaymentID INT AUTO_INCREMENT PRIMARY KEY,
    ReservationID INT NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    PaymentDate DATE NOT NULL,
    PaymentMethod VARCHAR(100) NOT NULL,
    FOREIGN KEY (ReservationID) REFERENCES Reservations(ReservationID)
);

