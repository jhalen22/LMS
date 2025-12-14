# LearnSpace - Learning Management System (LMS)

A comprehensive Learning Management System built with Laravel that enables instructors to create and manage courses while allowing students to browse, bookmark, and track their learning progress.

## Group Members
- **Glory Rose Ansay**
- **Jhalen Guadalquiver**
- **Loise Raphael Padriga**

## Deployment Link
**Live Application:**
https://lms-production-0be5.up.railway.app/

##  Frameworks & Technologies Used
- **Backend Framework:** Laravel 11.x (PHP 8.2+)
- **Database:** MySQL / MariaDB
- **Frontend:** Blade Templates + Tailwind CSS
- **Authentication:** Laravel Breeze
- **File Storage:** Laravel Storage (for PDF uploads)
- **Development Tools:** Composer, NPM, Vite

## Features

###  Instructor Features
- ✅ User registration and authentication with role selection
- ✅ Create courses with:
  - Title and descriptions
  - Full lesson content (rich text)
  - **Video embeds** (YouTube, Vimeo)
  - **PDF resource uploads** (up to 10MB)
- ✅ Edit and update existing courses
- ✅ Delete courses
- ✅ View instructor dashboard with all created courses
- ✅ Responsive course management interface

###  Student Features
- ✅ User registration and authentication
- ✅ Browse all available courses with course cards
- ✅ View detailed course information including:
  - Full lesson content
  - Embedded videos
  - Downloadable PDF resources
  - Instructor information
  - Creation and update dates
- ✅ **Bookmark courses** for later reference
- ✅ **Mark courses as completed** to track progress
- ✅ **My Bookmarks page** - view all saved courses
- ✅ **Completed Courses page** - track learning achievements
- ✅ Clean, nature-themed UI with smooth animations

###  Design Features
-  Nature-inspired green color scheme
- Fully responsive design (mobile, tablet, desktop)
-  Smooth hover effects and transitions
-  Intuitive navigation with role-based menus
-  Secure role-based access control

## Installation Instructions

### Prerequisites
Before you begin, ensure you have the following installed:
- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **MySQL** or **MariaDB**
- **Node.js** & **NPM** (for frontend assets)

### Setup Steps

1. **Clone the repository:**
```bash
git clone https://github.com/Glorans/LMS
cd learnspace-lms
```

2. **Install PHP dependencies:**
```bash
composer install
```

3. **Install Node dependencies:**
```bash
npm install
```

4. **Create environment file:**
```bash
cp .env.example .env
```

5. **Generate application key:**
```bash
php artisan key:generate
```

6. **Configure database in `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=learnspace_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

7. **Run database migrations:**
```bash
php artisan migrate
```

8. **Create storage symlink:**
```bash
php artisan storage:link
```

9. **Set storage permissions:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

10. **Build frontend assets:**
```bash
npm run build
```

11. **Start the development server:**
```bash
php artisan serve
```

12. **Visit the application:**
```
http://localhost:8000
```

## Database Structure

### Tables
- **users** - Stores user accounts (instructors and students)
- **courses** - Contains course information and content
- **course_user** - Pivot table for bookmarks and completions
- **sessions** - User session management
- **cache** - Application cache storage

### Key Relationships
- One instructor can create many courses
- Many students can bookmark/complete many courses (many-to-many)

## Authentication & Authorization

### User Roles
- **Instructor** - Can create, edit, and delete their own courses
- **Student** - Can browse, view, bookmark, and mark courses as complete

### Access Control
- Role-based middleware prevents unauthorized access
- Students cannot access instructor dashboard
- Instructors can only edit/delete their own courses

## Project Structure
```
learnspace-lms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Instructor/
│   │   │   │   ├── CourseController.php
│   │   │   │   └── DashboardController.php
│   │   │   └── Student/
│   │   │       └── CourseController.php
│   │   └── Middleware/
│   │       └── InstructorOnly.php
│   └── Models/
│       ├── User.php
│       └── Course.php
├── database/
│   └── migrations/
├── resources/
│   ├── views/
│   │   ├── instructor/
│   │   ├── student/
│   │   └── layouts/
│   └── css/
├── routes/
│   └── web.php
└── public/
```

## Usage Guide

### For Instructors:
1. Register as an instructor
2. Log in to access the instructor dashboard
3. Click "Create New Course" to add a course
4. Fill in course details, upload PDFs, add video URLs
5. Manage courses from the dashboard (Edit/Delete)

### For Students:
1. Register as a student
2. Browse available courses
3. Click "View Course" to see full details
4. Bookmark courses you're interested in
5. Mark courses as completed when finished
6. Access bookmarked and completed courses from the navigation



### Test Accounts (Create after deployment):
**Instructor Account:**
- Email: instructor@learnspace.com
- Password: password123

**Student Account:**
- Email: student@learnspace.com
- Password: password123

## Features Summary

| Feature | Instructor | Student |
|---------|-----------|---------|
| Register & Login | ✅ | ✅ |
| Create Courses | ✅ | ❌ |
| Edit/Delete Courses | ✅ (own only) | ❌ |
| Browse Courses | ✅ | ✅ |
| View Course Details | ✅ | ✅ |
| Upload PDFs | ✅ | ❌ |
| Embed Videos | ✅ | ❌ |
| Bookmark Courses | ❌ | ✅ |
| Mark Complete | ❌ | ✅ |
| View Bookmarks | ❌ | ✅ |
| View Completed | ❌ | ✅ |

## Contributing
This project was developed as an academic requirement. For any questions or issues, please contact the group members.

## License
This project is for educational purposes only.

## Contact
For any inquiries, please reach out to:
- **Glory Rose Ansay** - [gloryansay@gmail.com]

---
