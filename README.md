
<p align="center">
<h1>Testing Procedure</h1>
</p>

1- Clone the repository to your local machine using git clone https://github.com/GhofraneMrgh/Laravel_project-.


2- Create a new MySQL database and configure the Laravel project to use it by updating the ".env" file with your database settings.

3- Run the SQL script to create the necessary tables in your MySQL database by executing the commands : "php artisan migrate".

4- Run the Laravel code on your local machine using the command "php artisan serve".

5 - Open a web browser and visit the appropriate URLs to test various actions and features of the project :  
   <br> * /api/articles/import?siteRssUrl="votre url fichier xml" : this URL : will download the file, parse the xml and will save all the articles in a database. The raw content will be saved in the imports table, and each article will be saved in the articles table.
   <br> * /api/articles : this URL : Displays the articles in the databases

6 - Verify that the actions have been performed correctly by checking the database for the expected results. For example, if you created a new user account during the authentication test, check that the user account was created in the MySQL database.
