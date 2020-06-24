New Features: 
 
1. User information is no longer saved in the SQL database 

2. User information is now temporary and resets after 24 hours a. Initial user credentials are set when signing in, which is located in /htdocs/includes/sign-in.php b. Implemented 24 hour period before logoff, located in lines 5-10 in /htdocs/includes/utils.php 

3. Each user can only make a total of 15 likes per session a. Queries to insert like into database and increment like count located in /htdocs/services/increment-like-count.php b. Header to verify if resource is ok to be liked, already liked, or user needs to sign in to like located in lines 20-52 of /htdocs/assets/js/main.js 

4. Each user can only make a total of 5 comments per session a. Queries to insert comment into database and increment comment count located in /htdocs/services/add-comment.php b. Limit user comments to 5 per day located in lines 44-80 of /htdocs/assets/js/comments.js 

5. Each user now has a randomly generated profile image (chosen from ~10 images, mostly of animals) 
	a. On user sign in, user is assigned a logo for the next 24 hours (will reset on logoff); located on lines 16-47 on ​/htdocs/includes/sign-in.php 
	b. Users from the previous version of the website will keep their original images and comments 

Per the emailed questions, only new users will have a randomized profile picture. If a user was created on the old site and did not have an image, they will continue not to have an image. The Add Resource page has been updated with instructions. We do not see the empty box next to the sign in name when in another page, that could be a random bug. If it persists, please take a screenshot and we will look deeper into it, since we do not fully know what the issue is. Additionally, re signing in may remove the issue (which can be done by opening the page in a new incognito window, or waiting the 24 hours).