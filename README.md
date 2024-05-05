<h1 align="center" style="">Real Time Task Mangaement API Laravel</h1>

## About Project

Project is consiste of a real-time collaborative task management system using Laravel for the
backend and React.js for the frontend. The system allow multiple users to collaborate on a shared task list in real-time.

## Execute Project
    For better results, Please follow this steps:
- **Download project and in terminal do the command : "composer install"**
- **Create database named "skaalab_task_management"**
- **Migrate all tables : "php artisan migrate"**
- **To insert some fake data use : "php artisan db:seed"**
- **To insert some permissions data use : "php artisan db:seed --class=PermissionTableSeeder"**

## Detail of Endpoints 

- **Login User:** 
##### POST Method - /api/login
Return a list with access  token if user credentials are correct.
- **Register User:**
##### POST Method - /api/register
Return a specified user.
- **Create User:**
##### POST Method - /api/v1/users
Return a created user.
- **Update User:**
##### PUT Method - /api/v1/users
Returns a list of users.
- **Delete User:**
##### DELETE Method - /api/v1/users/{user}
Returns a deleted user.

- **Show All Tasks:** 
##### GET Method - /api/v1/tasks
Return a list of tasks.
- **Show Specified Task:**
##### GET Method - /api/v1/tasks/{task}
Return a specified task.
- **Create Task:**
##### POST Method - /api/v1/tasks
Return a created task.
- **Update Task:**
##### PUT Method - /api/v1/tasks
Returns a list of tasks.
- **Delete Task:**
##### DELETE Method - /api/v1/tasks/{task}
Returns a deleted task.

- **Show All Users:** 
##### GET Method - /api/v1/users
Return a list of users.
- **Show Specified User:**
##### GET Method - /api/v1/users/{user}
Return a specified user.
- **Create User:**
##### POST Method - /api/v1/users
Return a created user.
- **Update User:**
##### PUT Method - /api/v1/users
Returns a list of users.
- **Delete User:**
##### DELETE Method - /api/v1/users/{user}
Returns a deleted user.

