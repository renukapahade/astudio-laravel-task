# User, Project, and Timesheet Management API

This project is a RESTful API built using Laravel, designed to manage users, projects, and timesheets. It supports user authentication and provides endpoints for CRUD operations and filtering.

## Features

- **User Management**: Create, read, update, and delete users.
- **Project Management**: Create, read, update, and delete projects.
- **Timesheet Management**: Log tasks, hours, and associate them with users and projects.
- **Filtering**: Filter users and projects based on various attributes using `AND` logic.
- **Secure Authentication**: Used Laravel Sanctum for user authentication.

## Models

1. **User**:
   - Attributes: `first_name`, `last_name`, `date_of_birth`, `gender`, `email`, `password`.
   - Relationships: A user can have many timesheets and can be associated with multiple projects.

2. **Project**:
   - Attributes: `name`, `department`, `start_date`, `end_date`, `status`.
   - Relationships: A project can have many timesheets and many users.

3. **Timesheet**:
   - Attributes: `task_name`, `date`, `hours`, `user_id`, `project_id`.
   - Relationships: Each timesheet is linked to a single user and a single project.

## Installation Instructions

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/renukapahade/astudio-laravel-task.git
   cd astudio-laravel-task

2. **Install Dependencies**:
    ```bash
    composer install
    
3. **Run Migrations**:
    ```bash
    php artisan migrate
    
3. **Run the Development Server**:
    ```bash
    php artisan serve

## API Endpoints
**Authentication**
- Register: POST /api/register
- Login: POST /api/login
- Logout: POST /api/logout (requires auth token)

**Users (requires auth token)**
- Create User: POST /api/users
- Get All Users: GET /api/users
- Get User: GET /api/users/{id}
- Update User: POST /api/users/update
- Delete User: POST /api/users/delete

**Projects (requires auth token)**
- Create Project: POST /api/projects
- Get All Projects: GET /api/projects
- Get Project: GET /api/projects/{id}
- Update Project: POST /api/projects/update
- Delete Project: POST /api/projects/delete

**Timesheets (requires auth token)**
- Create Timesheet: POST /api/timesheets
- Get All Timesheets: GET /api/timesheets
- Get Timesheet: GET /api/timesheets/{id}
- Update Timesheet: POST /api/timesheets/update
- Delete Timesheet: POST /api/timesheets/delete

**Filtering (requires auth token)**
You can filter users and projects by various attributes. For example, to filter users:
- GET /api/users?first_name=John&gender=male&date_of_birth=1990-01-01
- GET /api/projects?name=Project%20Beta&status=completed&department=Design

## Database
A SQL dump of the database structure is provided in database.sql. You can import it into your SQL database.

## Postman collection
A Postman API collection is provided in postman_collection.json file. You can import it into Postman.







