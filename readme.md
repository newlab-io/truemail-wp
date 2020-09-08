=== TrueMail Email Validator ===

Stable tag:        5.4.1
Tested up to:      5.4.1
Requires at least: 4.6
Contributors:      TrueMail.io
Donate link:       https://truemail.io/
Tags:              email verification, email verify, email validation, real-time form validation, email verifier, email tester, email checker
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

TrueMail plugin can be seamlessly integrated with all forms to verify the user email address in real-time before submission.
Do not let fake or misspelt email addresses pass the form and get to the database.

The plugin uses TrueMail.io API platform - [https://truemail.io](https://truemail.io).

What can TrueMail plugin do?

- Syntax check
- Mail server validation
- Domain check
- Real-time email validation
- Disposable email address detection


= Supported Plugins =
The TrueMail email checker plugin supports a lot of popular form-based plugins by listening to email address capture flow or by hooking into WordPress is_email() function:

- Contact Form
- Gravity Forms
- WooCommerce
- Mailster Form
- MailChimp
- Ninja Forms
- Profile Builder
- Users Ultra registration form
- Ultimate Member registration form
- JetPack comments and a contact form
- Visual Form Builder
- Theme My Login
- WP-Members
- Paid Membership Pro
- Any WordPress registrations & contact forms    

= FURTHER READING =
Read more about TrueMail email verification service.

- [Features](https://truemail.io/features)
- [Help Center](https://help.truemail.io)
- [API Docs](https://developers.truemail.io/)
- [Integrations](https://truemail.io/integrations)
- [Google Chrome extension](https://chrome.google.com/webstore/detail/email-verifier/enchjidoodnbfkmidpfjlbdbjjlomfkp)
- [Blog](https://truemail.io/blog)

== Installation ==

### To get started:
1. [Sign up](https://truemail.io/app/signup) for TrueMail and get 1000 free credits.
1. Get your API key by clicking ["Create new app"](https://truemail.io/app/api-keys).
1. Click the newly created app and copy your API key from there.


### Installation using WordPress dashboard

1. Select **Plugins -> Add New**.
1. Search for "TrueMail Email Validator".
1. Click on *Install Now* to install the plugin.
1. Click on *Activate* button to activate the plugin.
1. Configure the plugin settings, including your API key and check/uncheck the role and disposable email validation.

### Manual Installation

1. Upload the plugin files to the `/wp-content/plugins/truemail-email-validator` directory.
1. Activate the plugin through the "Plugins" screen in WordPress.
1. Configure the plugin settings.


== Frequently Asked Questions ==

= How does it work? =
 
Once the TrueMail plugin is installed and activated, it will detect and check email fields present on the form when the form is submitted. During form submit, our plugin will make an API request to our service https://truemail.io with an email that needs to be verified. If the email verification results do not coincide with the ones you allowed, it will show an error message to the person entering the email address. When the email provided by the user is acceptable, form submission will proceed normally.

= How long does the email verification take? =

The email verification takes from few seconds to several minutes, depending on the type of the email address. If such an email has greylisting, the verification can take more.

= How accurate are the results? =

The accuracy of the results is about 99,9%.

= Does it verify catch-all emails as well? =

Yes, the TrueMail plugin can detect "catch-all" emails with the highest accuracy.

= Unable to find your answer here? =
Send us an email at support@truemail.io if you have any questions or need help. We will be happy to assist!

== Screenshots ==

1. Settings page. Here you put your API key and check/uncheck the role and disposable email validator options.
2. Example. Form denying invalid email address.
3. TrueMail page with generated API key. 
4. TrueMail analytics page. 
5. TrueMail credit usage page.

== Terms of Use ==

Check our terms - [https://truemail.io/terms](https://truemail.io/terms)


== Privacy Policy ==

Check our policy - [https://truemail.io/privacy](https://truemail.io/privacy)


== Changelog ==

= 1.0 =
- Initial release