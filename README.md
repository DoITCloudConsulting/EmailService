# Doitcloud Email Services

A Laravel package that provides email service integrations with configurable API keys, endpoints, and options.

---

## 🚀 Installation

Require the package via Composer:

```bash
composer require doitcloud/email-service
```

Publish the config file:

```bash
php artisan vendor:publish --tag=emailservice-config
```

Set the configuration values in the `config/emailservice.php` file.

## 📝 Configuration

The following configuration values are available:

- `tenant_id`
- `client_id`
- `client_secret`
- `scope`
- `login_domain`
- `path`
- `send_email_url`

## 📝 Usage

```php
use Doitcloud\EmailService\Http\Controllers\SendEmail;

$sendEmail = new SendEmail();
$sendEmail->send();
```

## 📝 License

MIT

## 📝 Support

For support, please open an issue on GitHub.

## 📝 Contributing

Please submit pull requests for new features and bug fixes.

## 📝 Credits

- [Hugo Hernandez](https://github.com/hugohernandez)

    