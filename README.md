# 🎓 Formation Management System

## 📌 Project Overview

**Formation Management System** is a web application designed to simplify and digitalize the management of training programs.

The platform provides an interface for managing training sessions, handling participant registrations, tracking available places, and evaluating participants' experiences.

The main goal is to centralize training-related operations and provide an efficient way for administrators and users to manage and follow training activities.

## 🎯 Objectives

- Simplify training program management.
- Centralize training information and registration processes.
- Manage training capacity and available places.
- Facilitate participant registration.
- Monitor and evaluate training participation.
- Improve the overall training management experience.

## ✨ Key Features

### 1. Training Management
- Create new training sessions.
- Display the list of available training programs.
- Update training information.
- Delete existing training sessions.
- Manage training categories and types.

### 2. Participant Management
- Allow users to register for training sessions.
- Prevent duplicate registrations.
- Check training availability before registration.
- Automatically update the number of available places.
- Prevent registrations when the training is full.

### 3. Training Evaluation
- Evaluate training sessions based on different criteria.
- Assess participation, rigor, and progress.
- Use a rating system to collect feedback.

### 4. User Interface
- Responsive and user-friendly interface.
- Training details and information display.
- Dedicated interfaces for administration and users.

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| Symfony | PHP web framework |
| Doctrine ORM | Database management |
| MySQL | Relational database |
| Twig | Dynamic template rendering |
| HTML5 | Web page structure |
| CSS3 | Styling |
| Bootstrap | Responsive interface |
| JavaScript | Frontend interactions |
| Git & GitHub | Version control |

## 🏗️ Application Architecture

The application follows the Model-View-Controller (MVC) architectural pattern provided by Symfony.

- **Model:** Entities and Doctrine ORM handle application data and database interactions.
- **View:** Twig templates display training information and user interfaces.
- **Controller:** Symfony controllers manage requests, business logic, and application workflows.

### Main Workflow

1. The administrator creates and manages training programs.
2. Users browse available training sessions.
3. Users select and register for a training session.
4. The system checks registration conditions and available places.
5. The number of available places is updated after successful registration.
6. Participants can evaluate their training experience.

## ⚙️ Installation and Setup

### Prerequisites

Make sure you have installed:

- PHP 8.x
- Composer
- Symfony CLI
- MySQL
- XAMPP or another local development environment.

### 1. Clone the Repository

```bash
git clone <YOUR_REPOSITORY_URL>
cd formation-management
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure the Database

Update the `DATABASE_URL` variable in your `.env` file:

```env
DATABASE_URL="mysql://root:@127.0.0.1:3306/projet_symfony?serverVersion=8.0"
```

Make sure your MySQL server is running.

### 4. Create and Update the Database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

If the database already exists, you can skip the database creation command.

### 5. Start the Application

Using Symfony CLI:

```bash
symfony server:start
```

Or using PHP:

```bash
php -S localhost:8000 -t public
```

Open your browser and navigate to:

```text
http://localhost:8000
```

## 📁 Project Structure

```text
formation-management/
│
├── assets/                  # Frontend assets
├── config/                  # Symfony configuration
├── migrations/              # Database migrations
├── public/                  # Public files and uploaded images
│   └── uploads/
│
├── src/
│   ├── Controller/          # Application controllers
│   ├── Entity/              # Database entities
│   ├── Form/                # Symfony forms
│   ├── Repository/          # Database queries
│   └── ...
│
├── templates/               # Twig templates
├── tests/                   # Automated tests
├── translations/            # Translation files
├── var/                     # Cache and logs
├── vendor/                  # Composer dependencies
├── .env                     # Environment configuration
├── composer.json
└── README.md
```

## 🔒 Business Rules

- A user cannot register more than once for the same training session.
- Registration is only possible when places are available.
- The number of available places is automatically decremented after a successful registration.
- Training sessions have defined capacity limits.
- Training evaluations use criteria such as participation, rigor, and progress.

## 🚀 Future Improvements

- Implement advanced search and filtering.
- Add email notifications for registrations.
- Introduce attendance tracking.
- Provide statistical dashboards.
- Add advanced user roles and permissions.
- Improve reporting and evaluation features.

## 👩‍💻 Author

**Salma Ben Romdhane**

- GitHub: [SalmaaBr](https://github.com/SalmaBr)

---

⭐ Feel free to explore the project and discover its features!
