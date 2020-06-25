Installing this project on a new server.

1. In the folder _secret, there is a php file where the MySQL database credentials are held (mysql_pass.php). First, change these credentials to match the MySQL database of the new server.
2. Make a new zip folder of the project.
3. Send the zip folder over to the new server with the following command:  scp -i [location of key] [location of zip folder] ubuntu@[server address]:~
4. Once it has finished uploading, connect to the server using the following command: ssh -i [location of key] ubuntu@[server address]
5. While connected to the new server, verify the zip folder has properly uploaded using the "ls" command. If the zip folder shows up, then it is good. If not seen, try using "cd ~", or re-uploading. 
6. If the zip folder is in the new server, than move to the /var/www folder using the following command: cd /var/www
7. If there is anything in the folder, first check whichever file has the MySQL credentials. Make sure the new zip folder has the same credentials. Once done, remove everything in the folder. Using the command "ls" should show nothing.
8. Return to ~ using the following command: cd ../..
9. Move the new zip folder to /var/www using the following command: sudo mv [zip folder] /var/www
10. Once again go to /var/www, and unzip the zip folder: sudo unzip [zip folder]
11. When it has finished unzipping, use "ls" to verify everything is there, and then remove the old zip folder. Do not remove the unzipped contents.
12. Finally, run the following two commands in order to restart the server: sudo apachectl stop, sudo apachectl start
13. The server should be up, and can be tested by going to the server address.