## BOOKING SYSTEM TIL VIDENSCENTER FOR ROBOT OG AUTOMATIONSTEKNOLOGI
The whole codebase, webside, api, and mobile apps are located under the repository https://github.com/JesperLeoMoberg/sdetobotdb<br>
It's owned by Jesper Leo Moberg, so only he can give access 

The website itself will be on http://udstyr.sde.dk/ and api on http://udstyr.sde.dk/api<br>
The android application for android will be in the repository, it can be compiled to apk inside intellij

if you have an experience with android development or eventually ios development, nodejs, and php, then it should be easy.
 <br> if you don't then you shouldn't probably rewrite the project.


### Webside
 The site is pure php, might use lavarel later to make it easier.
 The admin dashboard lies in `/admin`, it can only be accessed by an admin user with rank `1`.<br>
 The user page lies in `/user` and is composed based on the current logged in user.
 
 The website will NOT work without the api running. A php webpage is not a secure way of handling requests from an mobile application! 
 
 
 ### Api
  #### Libaries: 
  When got access and cloned the project, you should always run `npm i` in cmd in the api folder, ensuring you have nodejs installed.
  This will install all the libraries mentioned in the `package.json`. (An visual of the file is shown below)
 ```
 {
   "name": "api",
   "version": "1.0.0",
   "dependencies": {
     "boom": "latest",
     "hapi": "^18.1.0",
     "joi": "latest",
     "jsonwebtoken": "^8.5.1",
     "uuid": "^3.3.2"
   },
   "devDependencies": {
     "hapi-auth-jwt2": "^8.3.0",
     "hapi-mysql2": "^2.2.5"
   }
 }
 ```


    
    


 

