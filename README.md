# Camagru

A basic web application similar to instagram, used for uploading and sharing pictures.

# Requirements:

PHP
MAMP
JavaScript
CSS
HTML
MySQL

# Application setup steps:

1)  Install the Bitnami MAMP stack.

2)  Clear out your htdocs folder.

3)  Clone this repository into htdocs.

4)  Configure your MySQL database to use these default credentials initally:

    User: root
    Password: password

    Remember to change these in the application later on.

5)  Go to: http://localhost:8080/database/create, this should create the database and tables.

6)  Register and verify your registration via email.

7)  Login

8)  Enjoy.

# Architecture:

This is a typical MVC application with a few design patterns thrown into the mix. It makes use
of the C# Service-Repository pattern as well.

The main application flow can be summarized as this:

UI  --> Controllers --> Service     --> Repository  --> Database
UI  --> Controllers --> Repository  --> Database

Responsibilities:

  1)  Controllers

      Their job is to control / orchestrate the program flow between the UI and the Models or
      data access layer.

  2)  Models are the classes constructed when database state gets reconstituted, however, in
      my case, I used repositories without explicit models as the design is simple enough to
      allow it.

  3)  Views, they are the actual HTML files / components that gets returned by the controllers

  4)  Interfaces, they are used to ensure loose coupling between dependencies.

  5)  Services, the business logic lives here, the controllers will sometimes make use of the
      services.

  6)  Config, simple a place to store configuration files.

  7)  Assets, common application assets like icons etc.

  8)  Classes (folder), a folder to store common used classes.

# Testing

  1)  These are the tests that I executed:

      a)  Preliminary Checks, used PHP, no external frameworks, config files at correct location.
          Used PDOs.

      b)  Webserver starts.

      c)  Create an account.

      d)  Log in.

      e)  Capture picture using the webcam.

      f)  Visit gallery.

      g)  Change user credentials.

  2)  Expected outcomes:

      a)  Backend code written in php.

      b)  No frameworks used.

      c)  database.php + setup.php in the config folder.

      d)  Used PDOs.

      e)  Websever starts and gallery is located at http://localhost:8080.

      f)  Able to register.

      g)  Able to log in.

      h)  Able to capture a picture.

      i)  Able to visit the gallery.

      j)  Able to change your credentials.
