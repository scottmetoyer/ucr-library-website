cd docroot
eb deploy
mysqldump.exe --user=drupaluser --password= --host=127.0.0.1 --protocol=tcp --port=33067 --default-character-set=utf8 --routines "ucr_library_website" > "export.sql" 
mysql.exe -h drupal.chk68pb8tfr5.us-east-2.rds.amazonaws.com -u root -P 3306 -p library_website < "export.sql"
del export.sql
cd ..
echo "Done - site is up at http://ucr-library-website-test.us-east-2.elasticbeanstalk.com/"