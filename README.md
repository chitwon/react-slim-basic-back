# BACKEND -- MathCart React Slim Skeleton - A good starting point for react front end with google login to protect routes from a slim php backend API -- BACKEND

  This is a SLIM PHP app that can work as a backend to a repo I created for a React front end with basic protected routes using google login. 
  
  Front end repo found here https://github.com/chitwon/react-slim-basic-back
  
# What this app does? 

This slim PHP app is a REST backend with protected routes that works with the front end linked above. 
    
  # How to make this work with the front end repo.
  
  - Clone this repo and the front end repo
  - In the SLIM php app, 
    - set up your db in the file src\mathCart\db.php __construct method
    - set up the $client->setRedirectUri  around line 38 in the file src\mathCart\apiAccess.php. That is where google will redirect after user verifies login.
    - Right now the CORS of this app is set wide open for development. If you want to lock it down more, the headers are in the public\index.php file. 
    - Set up the below tables in your db. 
  - Follow the instructions in the front end repo.
  
# How I use it for this demo

If you use this as a starting point for your own app, you can keep the token exchanging pretty much the way it is here. To demonstrate protected routes, I have set up a simple procedure to retrieve student homework from the database. (I developed this for a student management app). You could do something similar rather easily. In the app I protect routes through SLIM's middle wear by appending the route with ->add($checkToken) and define the $checkToken function in the file \src\middleware.php. For that route to work, the front end needs to send the appropriate token and email for verification. Currently only POST routes are protected. 


# SQL stuff...
TABLE to exchange tokens....

CREATE TABLE IF NOT EXISTS `exchanged_tokens` (
  `mc_token` varchar(255) NOT NULL,
  `google_token` text NOT NULL,
  `mc_expires` datetime NOT NULL,
  `google_expires` int(11) NOT NULL,
  `exchange_time` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`mc_token`)
) 


 TABLE for protected content used for demonstrations purposes. 
 
 CREATE TABLE IF NOT EXISTS `submitted_hw` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_email` varchar(300) NOT NULL,
  `hw_title` text NOT NULL,
  `hw_id` int(11) DEFAULT NULL,
  `hw_link` text,
  `submission_date` date DEFAULT NULL,
  `submission_points` int(11) DEFAULT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `student_email` (`student_email`)
)

