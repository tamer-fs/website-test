import smtplib
import ssl

email_from = "vliegendekip6@gmail.com"
password = "sslqtswjvacagejo"
email_to = "tf.sparreboom@gmail.com"

email_string = "Hello test"

context = ssl.create_default_context()

with smtplib.SMTP_SSL("smtp.gmail.com", 465, context=context) as server:
    server.login(email_from, password)
    server.sendmail(email_from, email_to, email_string)
