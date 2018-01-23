
## Exploring Laravel 5.4

Scope: explore as much of the Laravel 5.4 framework capabilities in developing a web app

## Functionalities

1. New User Registration

- Any user could register with an email address. 
- The application sends a verification link to the email address (PHPMailer, not Swift). 
- When the user clicks the link, the application asks for a new password 

Now the user is registered and is able to publish articles.

2. CRUD for simple News Object

- When logged in, the user can add or edit/remove his own published news
- For each news article the following information is required:
    * Title
    * A single photo
    * Text
    * Current date and time
    * Author user name / email 
- W/o logging, the user can see the latest 10 news, regardless of the author. Upon clicking, it shows the complete article.

3. PDF download for the articles

4. RSS feed for the latest 10 news