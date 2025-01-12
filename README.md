# COBIT5 Management System 📊⚙️

Welcome to the **COBIT5 Management System**! This project is a comprehensive system designed to help manage and implement COBIT 5 frameworks in organizations. It helps businesses align their IT with their business goals and provides governance, risk, and compliance management.

## 🚀 Features

- **User Authentication** 🔐: Secure login system using Auth0.
- **Role-based Access** 🎭: Differentiated permissions for Admins and Principals.
- **Comprehensive Management** 🧑‍💼: Tools for managing COBIT 5 processes effectively.
- **Reporting** 📑: Real-time performance and compliance reporting.
- **Audit Trails** 🕵️‍♂️: Keep track of actions for compliance purposes.

## 📦 Installation

To get started, follow these steps to clone and set up the project:

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/yourusername/cobit5-management-system.git
    ```

2. **Install Dependencies**:
    - Make sure you have [Composer](https://getcomposer.org/) and [Node.js](https://nodejs.org/) installed.
    - Run the following commands to install the required PHP and JavaScript dependencies:
    ```bash
    composer install
    npm install
    ```

3. **Set Up Environment File**:
    - Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5. **Migrate Database**:
    ```bash
    php artisan migrate
    ```

6. **Serve the Application**:
    ```bash
    php artisan serve
    ```

Now you should be able to access the application at `http://localhost:8000`.

## 🔑 Technologies Used

- **PHP (Laravel 11)** 🖥️
- **MySQL** 🗄️
- **JavaScript** 🎨
- **Bootstrap** 💅

## 📊 Development Activity

Check out the development activity on Wakatime for detailed statistics on coding time and progress:

[**Wakatime Activity Report (Jan 6, 2025 - Jan 12, 2025)**](https://wakatime.com/@sonyadi/projects/seqpvmamjl?start=2025-01-06&end=2025-01-12)

## 📸 Screenshots

Here are some screenshots of the COBIT5 Management System:

![image](https://github.com/user-attachments/assets/3fa8b697-1ce8-4850-b9e3-28ff39c9c48c)

_**Login Page:**_ The user-friendly login screen for easy access.

![image](https://github.com/user-attachments/assets/1e7e2ca2-e044-4f08-87b0-6969eb463918)

_**Dashboard:**_ The main dashboard showing the management interface.

![image](https://github.com/user-attachments/assets/d1ab6437-75ca-4fdd-a396-5eb7f486b95b)

_**Audit Project:**_ A page that displays the audit processes of various projects.

![image](https://github.com/user-attachments/assets/7c9c2dcc-dbac-4ef3-a4f1-22d6c67c5206)

_**Audit Detail:**_ A page dedicated to detailed testing and verification during the audit process.

## 👥 Contributing

We welcome contributions to make the system even better! Feel free to fork the repo, make changes, and submit a pull request. 

### How to Contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature/new-feature`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to your branch (`git push origin feature/new-feature`).
6. Submit a pull request.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

✨ **COBIT5 Management System** is built to help you streamline governance, risk, and compliance. Let's make IT better together! ✨
