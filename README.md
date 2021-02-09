# ijme-wp-theme

For sendpress plugin not working - emails not sending

Set the time for the server, SES uses timestamp to verify/authenticate the users

sudo service ntp stop
sudo ntpd -gq
sudo service ntp start

