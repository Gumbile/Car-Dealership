# Car Dealership Management System

This project is a web-based application for managing a car dealership system. It includes features for adding and managing cars, users, reservations, and payments. The system uses PHP for the backend, MySQL for the database, and HTML/CSS/JavaScript for the frontend.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Kambood/Car-Dealership.git
   cd Car-Dealership
   ```

2. Set up the database:
   - Create a MySQL database named `car_dealership`.
   - Import the SQL schema from `SQL/DDL.sql` into the database.
   - Optionally, generate sample data using the Python script `python script/main.py`.

3. Configure the database connection:
   - Update the database connection details in `Pages/config/db_connect.php`.

4. Start a local server:
   - Use a local server environment like XAMPP, WAMP, or MAMP to serve the project files.
   - Place the project files in the server's root directory (e.g., `htdocs` for XAMPP).

## Usage

1. Open a web browser and navigate to the local server's address (e.g., `http://localhost/Car-Dealership`).

2. Use the provided login credentials to access the system:
   - Admin: `admin@example.com` / `password`
   - User: `user@example.com` / `password`

3. Explore the various features of the system, such as adding cars, managing users, making reservations, and processing payments.

## Contributing

Contributions are welcome! If you would like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes and commit them:
   ```bash
   git commit -m "Add your commit message"
   ```
4. Push your changes to your forked repository:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request in the original repository.

## Contact

For any questions or inquiries, please contact the project maintainer:

- Name: Kambood
- Email: kambood@example.com

## Acknowledgments

- This project was developed as part of a web development course.
- Special thanks to the contributors and open-source libraries used in this project.
