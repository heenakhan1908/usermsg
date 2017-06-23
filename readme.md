# Readme
# User Messenger

User Massenger is a simple web application to demonstrate permission management using PHP. It does following things
- Create a new user [Admin]
- Update His own profile information [User]
- Update any user’s profile information [Admin, Manager]
- Post a message [User]
- Delete Any message [Admin]
- Delete Own message [Admin]
- Block User [Manager, Admin]
- View All users [User, Manager, Admin]
### Roles
There are three roles of user
- Admin
- Manager
- User

## How to install on localhost

### Linux(Ubuntu/Mint) and MacOS 
- Copy all the contents to  **/var/www/html/usermsg** _(Linux)_ or **/Library/WebServer/Documents** _(MacOS)_
- Import database from file **myAssignDb.sql** using **phpMyAdmin**
- Update the database connection information in the file **functions.php**. 
-- Find a function name **connectdB()**
-- Update following code as per your localhost setup
```
    $db_host="localhost";

    $db_user="root";

    $db_password="root";
```
- Now type **localhost/usermsg** to run the application in your browser.

### Default Users (Login Details)
- useradmin (Admin) Password: 12345@Admin 
- salman (User) password: 12345@Salman 
- mgr (Manager) password: 12345@Mgr

*****Note: Best viewed in Firefox 54 and Google Chrome 58***** 