# EverydayMerchandise

Everyday Merchandise: (CSCI 110 online store) Spring 2017

## Description: 
- This was a class project that uses mainly PHP, HTML, SQL, and a little bit of javascript.
- This project is an online store that consists of a front end for users.
- Users can browse items and put them in their cart.
- It has accounts that allows users to login and start/continue/finish orders.

## Process:
- This project has lots of moving parts, i.e. it has lots of pages working together, passing information back and forth.
- I created this one page at a time, but I had a general page that I included to every page. It included things like the header and the footer.
- The webpages would communicate with a Microsoft Access database to retrieve,  insert, and update data.

## Difficulties Faced: 
- When users would type information into forms and press submit, if they were missing anything or there was incorrect data, they would be sent back to the page they were inputting the data on and all the forms would be empty.
  - Solution: On the page that I was capturing and sanitizing the data, I would have an “error” variable that served as a flag. If there was any error in the way the user had entered in the data, the flag would be filled with a custom error message and the data would be sent back to the original page via a “hidden” input form along with the error message.

## New Skills Acquired:
- General security skills such as how to capture and sanitize data by sending user info (names, emails, phone numbers, etc.) to a page that pulls in the data, makes sure each input doesn’t violate any basic rules (such as letters in phone numbers), and from there determines if the user must re enter data or if he/she may continue.
- I learned how sessions are implemented for online stores by using a session string concatenated to a bool determining if the user is logged in or not, concatenated again to a customer_id. If the customer is not logged in, they receive the “anonymous” customer_id that is the same for all people that aren’t logged into an account.
- I learned how to make dynamic web pages that communicate with a database.

## Screen Shots
![frontpage](https://user-images.githubusercontent.com/28938321/33308447-54e43c9e-d3cf-11e7-92a6-17f76ec92d9f.PNG)
![login](https://user-images.githubusercontent.com/28938321/33308515-9fa1920e-d3cf-11e7-96fc-2f3a14b933de.PNG)
![myaccount](https://user-images.githubusercontent.com/28938321/33308576-e89dd0b2-d3cf-11e7-8687-7c0019297be8.PNG)
![ordersummary](https://user-images.githubusercontent.com/28938321/33308565-d98255ee-d3cf-11e7-8378-32d50b2c9406.PNG)
![orders](https://user-images.githubusercontent.com/28938321/33308585-f4d9b35a-d3cf-11e7-8be2-9187bce1c22a.PNG)
