# ParaEase'O
ParaEase'O is a sample tourism portal website. It was made as a second-year university project. ***It is not being used commercially and was made as a student project only.***

## Status
It is not being maintained anymore as project development period has ended.

## Features
 - Users can inquire about the provided tour packages through the submission of forms.
 - Users can submit website feedback through the form at the About Us page.

## Dependencies
- [XAMPP](https://www.apachefriends.org/download.html) is needed to make this site work. Make sure it comes with MySQL.

## Installation
1. Download the repository files or clone the repository. Place the repository files inside the configured document root of your XAMPP installation. If you have not changed your document root, the default path will be inside the `htdocs` folder of your XAMPP installation folder.
2. Open the XAMPP control panel and start both Apache and MySQL.
3. Open your preferred browser. Navigate to the PHPMyAdmin dashboard. The default path to it is [http://localhost/phpmyadmin/index.php](http://localhost/phpmyadmin/index.php).
4. Create a new database. Name it `db_paraiso`.
5. Go to the `Import` tab and import the `db_paraiso.sql` file.
6. You are now ready. Open the `index.php` file of the project in your browser by typing `localhost/{relative path to the index.php file}`.

## Admin Page
The website features an admin page. To access this, open the `admin.php` file of the project in your browser by typing `localhost/{relative path to the admin.php file}`. If you're not already logged in, it will redirect you to the login page. The default username for the admin account is `admin` while the default password of the admin account is `password`.
