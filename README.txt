Computer Service Servicing Status Script
Version 1.1
Copyright (c) 2014, Chris Formeister. All Rights Reserved.

REQUIREMENTS
------------
PHP 5.x or later
MySQL Server

INSTALLATION
------------
1. Copy all the files (except this one) to your WWW root. You can change the script code to reference files in a subdirectory if you wish.
2. Import the repairstatus.sql file using phpMyAdmin or equiv.
3. Configure your SQL information in the repairadmin-config.php and repairstatus-config.php files.
3a. Verify the script works. Open repairstatus.php and enter 12345 for the Invoice ID. You should get the results.
3b. Open the Admin script, repairadmin.php. Add a record (Currently it requires 5 digits, you can change this if you wish...)
4. Open the User-facing script, repairstatus.php. Enter your record number your entered, and view the magic!
5. Edit the necessary stuff to customize it to your liking.
5. I suggest using .htaccess or equiv. to restrict access to the config files and admin page

SUPPORT
-------
I don't offer any support for the script except for bugs.

CHANGES & HELP
--------------
The script likely has bugs and is hastily thrown together in areas. It was designed for my personal use, but because of the utility of it, I decided 
to release it.

If you have suggestions, new code, want to clean up the scripts and optimize them, by all means please share them with me so
I can include them in a future version. I will be happy to include you in the Credits. You can email them to azchrisf@gmail.com or
submit them via Github - http://www.github.com/azchrisf

When you share innovative changes, it helps everyone who may use this script.

DONATIONS
---------
If this script helped you, please consider shooting me an email at azchrisf@gmail.com and I'll send my PayPal email.
It takes time and resources to program things like this, and at the moment, there is nothing on the market
that is free like this. As said above, I use this for myself, as I don't want to pay $200+ for something similar.

LICENSE
--------------
Feel free to redistribute this package AS-IS.
This package may be redistributed ONLY if the original files are kept intact as they were originally uploaded, and
my information is kept intact and in the script.

You may use this script for commercial purposes, but I really request you make a donation if you do. You are free to
make changes to the script as you see fit for your own use, but any changes you make CANNOT be redistributed.

If you don't accept these terms, don't use the script. By using this script, you automatically agree to these terms.

~~~Enjoy!~~~