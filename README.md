## BOOKING SYSTEM TIL VIDENSCENTER FOR ROBOT OG AUTOMATIONSTEKNOLOGI
The whole codebase, webside, api, and mobile apps are located under the repository https://github.com/JesperLeoMoberg/sdetobotdb<br>
It's owned by Jesper Leo Moberg, so only he can give access 

The website itself will be on http://udstyr.sde.dk/ and api on http://udstyr.sde.dk/api<br>
The android application for android will be in the repository, it can be compiled to apk inside intellij

if you have an experience with android development or eventually ios development, nodejs, and php, then it should be easy.
 <br> 


### Webside
 The site is pure php, might use lavarel later to make it easier.
 The admin dashboard lies in `/admin`, it can only be accessed by an admin user with rank `1`.<br>
 The user page lies in `/user` and is composed based on the current logged in user.
 
 The website will NOT work without the api running.
 
 
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

  Check if wishlist accrue between 2 dates.
    SELECT * FROM `wish_list` WHERE (`start_date` <= '2019-06-30') and (`end_date` >= '2019-06-27') AND godkendt = 0
    

check for between 2 dates the product not available :

SELECT school_products_id,SUM(quantity) as total_quantity FROM connection_product_wishlist as cw
INNER JOIN wish_list as wl ON cw.wish_list_id = wl.id
WHERE (`start_date` <= '2019-06-30') and (`end_date` >= '2019-06-27') AND godkendt = 0
GROUP BY school_products_id
 

Check available product quantities from between 2 dates.

SELECT school_products_id,(SELECT COUNT(pe.products_id) from product_unit_e as pe WHERE pe.products_id = cw.school_products_id and pe.current_status_id = 1) - SUM(cw.quantity) as total_quantity FROM connection_product_wishlist as cw
INNER JOIN wish_list as wl ON cw.wish_list_id = wl.id
WHERE (wl.start_date <= '2019-06-30') and (wl.end_date >= '2019-06-27') AND godkendt = 0
GROUP BY school_products_id

SELECT school_products_id,sp.product_name,sp.description,sp.movable,(SELECT COUNT(pe.products_id) from product_unit_e as pe WHERE pe.products_id = cw.school_products_id and pe.current_status_id = 1) - SUM(cw.quantity) as quantity_left FROM connection_product_wishlist as cw
         INNER JOIN wish_list as wl ON cw.wish_list_id = wl.id
         INNER JOIN school_products as sp ON cw.school_products_id = sp.id
         WHERE (wl.start_date <= '2019-06-30') and (wl.end_date >= '2019-06-27') AND godkendt = 0
         GROUP BY school_products_id



SELECT sp.id,sp.product_name,sp.description,sp.movable, COUNT(pe.products_id) -
(
SELECT IFNULL((SELECT SUM(cw1.quantity) FROM connection_product_wishlist as cw1
INNER JOIN wish_list as wl1 ON wl1.id = cw1.wish_list_id
WHERE (wl1.start_date <= '2019-06-30') and (wl1.end_date >= '2019-06-27') AND wl1.godkendt BETWEEN 0 AND 1 AND cw1.school_products_id = sp.id
GROUP BY cw1.school_products_id
),0) as quantity
) as quantity 
FROM school_products as sp
INNER JOIN product_unit_e as pe ON sp.id = pe.products_id 
WHERE 
pe.current_status_id = 1 
GROUP BY pe.products_id