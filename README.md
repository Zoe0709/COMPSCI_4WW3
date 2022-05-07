# COMPSCI 4WW3 Project MuseuM Master

 
## Overview:
**Course:** COMPSCI 4WW3\
**Term:** 2021 Fall\
**Group Members:**\
1). Zoe Ning, ningh4\
2). Abdullah AbdulMaksoud, abdulmaa\
**Links to Website:** https://museumaster.me/index.php


## Demo: 
![](/img/projectDemo.gif)


## Description: 
MuseuMaster is a secured website that helps users discover museums around the world. Finding and exploring favorite museums are difficult, and an improper choice of museum can waste your precious time and money. With our website, that will not be a problem. MuseuMaster allows users to search for museums by names, ratings, or their geolocations so they can pick up interested museums to visit. For each individual museum, users can view all comments and ratings of it to gain comprehensive understanding. Detailed information such as address and description is also exhibited. When new museums are discovered, any user can submit them to the website with details.


## Website Features:

### Server Deployment:
The project is deployed on a live website with a domain name museumaster.me, and it is secured by an SSL certificate. The website uses MySQL database management system and phpmyadmin as MySQL administration tool. 
An Amazon S3 bucket was also set up for storing user-uploaded images and museum introduction images and videos.

### Searching:
Search by location: use "My Location" button to get user's current location automatically; or type in the latitude and longitude with at most three decimal places.
Search by name: users can type in the key words, all museums that contain the key words in their names will be returned.
Search by rating: choose rating from dropdown box and click the button, museums with rating that is smaller than or equal to the input and greater than input - 1 will be returned.

### Search Results:
The result page of a search are dynamically generated displaying eligible museums both on a map and in tabular format. A fully functional google map has been implemented that allows the user to view the real locations through markers and zoom in or out for geographic details. The tabular format contains important information of each result museum, like museum name, museum average rating, museum address, and a link to the detailed individual page. The average rating of a museum can automatically get updated when a new review of it is posted. 
The individual page of a museum is also dynamically generated. A live google map using JavaScript that shows the location of the museum has been implemented. Detailed information, reviews of the museum, and introduction images and videos are all extracted from database and formatted to show up. A form to add a new review was also included. Only logged in users are permitted to submit new reviews, and one user can only review one museum once.

### Registration and Log in:
Users can create accounts by clicking the sign up button at the top right corner. Validation for all fields are implemented, note that user passwords have to contain at least one lowercase letter, one uppercase letter and a number. Hashing algorithms were to secure the password and guard user accounts from both internal and external unauthorized access.
Users can log in on the sign in page. If logged in successfully, the website jumps to a profile page that displays user account information. Validation for sign in username and password areas are implemented.
