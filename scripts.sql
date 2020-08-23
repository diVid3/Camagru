-- Database

CREATE DATABASE IF NOT EXISTS camagru;

USE camagru;

CREATE TABLE Account(
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(64) NOT NULL UNIQUE,
  email VARCHAR(64) NOT NULL UNIQUE,
  password VARCHAR(64) NOT NULL,
  verifyHash VARCHAR(64) UNIQUE,
  resetHash VARCHAR(64) UNIQUE,
  canNotify TINYINT(1) NOT NULL
);

CREATE TABLE Picture(
  id INT AUTO_INCREMENT PRIMARY KEY,
  accountId INT NOT NULL,
  path VARCHAR(64) NOT NULL,
  FOREIGN KEY (accountId)
  REFERENCES Account(id)
  ON DELETE CASCADE
);

CREATE TABLE Comment(
  id INT AUTO_INCREMENT PRIMARY KEY,
  pictureId INT NOT NULL,
  text TEXT NOT NULL,
  FOREIGN KEY (pictureId)
  REFERENCES Picture(id)
  ON DELETE CASCADE
);

CREATE TABLE Liker(
  id INT AUTO_INCREMENT PRIMARY KEY,
  accountId INT NOT NULL,
  pictureId INT NOT NULL,
  FOREIGN KEY (accountId)
    REFERENCES Account(id)
    ON DELETE CASCADE,
  FOREIGN KEY (pictureId)
    REFERENCES Picture(id)
    ON DELETE CASCADE
);

-- Accounts

-- Pictures

SELECT Picture.id, Picture.path FROM Account INNER JOIN Picture ON Picture.accountId = Account.id WHERE Account.email = 'genisevert7@gmail.com' ORDER BY Picture.id DESC;

-- Comments

-- Likers
