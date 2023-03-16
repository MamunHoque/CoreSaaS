CoreSaaS
========

CoreSaaS is a starter kit for building Software as a Service applications. It is built with Laravel 10 and Bootstrap 5 and includes a set of features commonly found in SaaS applications.

Features
--------

### Authentication

CoreSaaS provides a robust authentication system out of the box. Users can register for an account, confirm their email, and log in securely with their credentials. The authentication system also includes password reset and two-factor authentication.

### User Profiles

Users can view and edit their profiles, including personal information, billing details, and subscription status.

### Team Management

CoreSaaS allows users to create and manage teams. Team members can be invited to join a team and assigned roles and permissions. Team owners can manage team settings, including billing and subscriptions.

### Billing and Subscriptions

CoreSaaS supports multiple payment gateways and allows teams to manage their billing and subscription plans.

### Invoices

Teams can view and download their invoices for their subscription payments.

### Announcements

Team owners can create and send announcements to team members, keeping everyone informed about important updates and news.

### Notifications

Users receive notifications about events in the application, such as new announcements or changes to their subscription status.

### API

CoreSaaS includes a fully functional API that can be used to build custom integrations or client applications.

### Session Management

CoreSaaS provides secure and robust session management to ensure that users are authenticated and authorized for the actions they perform in the application.

### Roles and Permissions

CoreSaaS supports roles and permissions, allowing team owners to grant or restrict access to specific features or actions in the application.

### Support Ticket

CoreSaaS includes a support ticket system for teams to report issues or ask for help from the support team.

### Multi-Workspace and Team

CoreSaaS allows teams to create multiple workspaces, each with its own set of users, roles, and permissions.

### Clean PHP Code

CoreSaaS is built with clean, well-documented PHP code that is easy to read and maintain.

Getting Started
---------------

To get started with CoreSaaS, you will need to have PHP and a database server installed on your system. You can then clone the CoreSaaS repository and update .env then run the following commands:

```composer install
php artisan migrate --seed
php artisan serve```

These commands will install the required dependencies, create the database tables, and start the application.

Configuration
-------------

CoreSaaS includes a configuration file that can be used to customize the application settings, such as the email provider or the payment gateway. You can find the configuration file at `config/coresaas.php`.

Contributing
------------

CoreSaaS is an open-source project, and contributions are welcome. To contribute, please fork the repository, make your changes, and submit a pull request.

License
-------

CoreSaaS is released under the MIT License. See `LICENSE` for more information.
