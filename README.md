# Certificate Generator & Mailer

This is a simple PHP script to generate certificates from a CSV file, add names to a template image, and then generate PDF certificates. It also includes a function to send the certificates via email using PHPMailer.

## Prerequisites

To run this script, you need to have the following software installed on your system:

- PHP (version 5.6 or higher)
- PHP GD library enabled
- FPDF library
- PHPMailer library

## Built With

- [FPDF](http://www.fpdf.org/) - A PHP class to generate PDF files
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - A PHP email sending library

## Installation

1. Clone the repository to your local machine or server:

```sh
git clone https://github.com/ServiceToMankind/certificate-generator.git
```

2. Install PHP dependencies via Composer:

```sh
composer install
```

3. Update the SMTP settings in the `mailer.php` file with your email provider's SMTP credentials.

4. Update the CSV file with your workshop attendees' data.

## Configuration

You can configure the following settings in the certificate_generator.php file:

- `$font:` the path to the TrueType font file to use for the participant name
- `$image:` the path to the background image to use for the certificate
- `$color:` the RGB color value for the participant name text
- `$pdfpath:` the path to save the generated PDF files to

### You can also configure the SMTP settings for sending emails in the mailer.php file:

```php
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@stmorg.in';                       //SMTP username
    $mail->Password   = 'SECRET';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('reach@stmorg.in', 'STM');
    $mail->addAddress($email, $name);         //Add a recipient
    $mail->addAddress($email);               //Name is optional
    $mail->addReplyTo('reach@stmorg.in', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
```

## Usage

1. Place the template image you want to use in the `templates` directory.

2. Update the template image file path in the main script `index.php`.

3. Run the script in the terminal:

```sh
php index.php
```

4. The script will generate a PNG image with the attendee's name, convert it to a PDF, and send it via email to the attendee's email address.

## Note:

For larger data sets, the script may take longer to execute. If you encounter any issues with the script timing out, you may need to increase the `max_execution_time` value in your PHP configuration file[`php.ini`]. You can also consider breaking the data into smaller chunks and running the script multiple times to avoid timeouts.

```php
max_execution_time=500
```

## License

This project is licensed under the [MIT License](https://github.com/ServiceToMankind/digital-certificate-generator-and-mail/blob/main/LICENSE).
