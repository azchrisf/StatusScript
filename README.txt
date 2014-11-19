Computer Service Servicing Status Script
Version 1.5
Copyright (c) 2014, Chris Formeister. All Rights Reserved.

+------------+
|INTRODUCTION|
+------------+

This is a front-facing PHP script that provides customers of computer repair
service businesses a "status" of their machine being repaired. It shows them
if the machine is being worked on, the expected repair time, delivery time,
etc.

It is mildly customizable, but fully customizable to suit your needs by
editing the code.

+------------+
|REQUIREMENTS|
+------------+

PHP 5.2.0 or later (Short open tags MUST be enabled)
MySQL Server 5.0 or later
Apache or IIS Webserver
AJAX-capable Browser (latest Firefox recommended)

INSTALLATION
------------
1. Copy all the files (except this one) to your WWW root or subdirectory.
2. If this is a new install, Import the repairstatus.sql file using phpMyAdmin or an equiv. If this is an upgrade, use the upgradeXX-XX.sql file
   to go from the version you had installed to this version. If you are behind versions, use all of the previous upgrade files - example, if
   you are upgrading from 1.0 to 1.3, import upgrade10-11.sql, upgrade11-15.sql and so on. If upgrading from 1.1 to 1.5, import
   upgrade11-15.sql. See the pattern? :)
3. Configure your SQL information in the repairadmin-config.php and repairstatus-config.php files.
3a. Verify the script works. Open repairstatus.php and enter 12345 for the Invoice ID. You should get the results.
3b. Open the Admin script, repairadmin.php. Add a record (Currently it requires 5 digits, you can change this if you wish...)
4. Open the User-facing script, repairstatus.php. Enter your record number your entered, and view the magic!
5. Edit the necessary stuff to customize it to your liking, or completely rewrite the script to suit your needs.
5. I suggest using .htaccess or equiv. to restrict access to the config files and admin page.

SUPPORT
-------
No support is offered for the script outside of bugs. If a bug is present, please post an issue on github under "Issues" on the project page.
You can obtain the latest versions and bug-fixes at http://www.github.com/azchrisf/StatusScript -
Bug fixes for the current version are labeled as "QFE x" on the respective file. Download those specific files and upload them to your server.

CHANGES & HELP
--------------
The script likely has bugs and is hastily thrown together in areas. It was designed for my personal use, but because of the utility of it, I decided 
to release it, and by request, have added on to it. I sometimes go thru different areas and clean them up as necessary.

If you have suggestions, new code, want to clean up the scripts and optimize them, by all means please share them with me so
I can include them in a future version. I will be happy to include you in the Credits. You can email them to azchrisf@gmail.com or
submit changes via Github - http://www.github.com/azchrisf

When you share innovative changes, it helps everyone who may use this script.

DONATIONS
---------
If this script helped you, please consider shooting me an email with a note at azchrisf@gmail.com and I'll send my PayPal email.
It takes time and resources to program things like this, and at the moment, there is nothing on the market
that is free like this. As said above, I use this for myself, as I don't want to pay $200+ for something similar.

UPGRADE NOTES
-------------

If upgrading from a previous version, make sure to import the upgradeXX-XX.sql file(s) as noted in the INSTALLATION section.

If upgrading from 1.0, DO NOT enable the PIN Security feature retroactively unless you manually edit the database and add
PIN codes, or the script will fail to load your Invoices.

LICENSE
--------------
Feel free to redistribute this package AS-IS.
This package may be redistributed ONLY if the original files are kept intact as they were originally uploaded, and
all information is kept intact and in the script.

You may use this script for commercial purposes, but I really request you make a donation if you do. You are free to
make changes to the script as you see fit for your own use, but any changes you make CANNOT be redistributed. If you
wish, submit them and they may be included in the script for everyone's use.

This script contains files and code from other authors. The license for those files may be different - check the files
for additional information and license terms.

If you don't accept these terms, don't use the script. By using this script, you automatically agree to these terms.

~~~Enjoy!~~~
