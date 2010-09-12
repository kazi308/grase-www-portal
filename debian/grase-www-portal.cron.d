# /etc/cron.d/grase-www-poral: crontab fragment for grase-www-portal
# This clears stale sessions and at the end of the month, moves user accounting
# details into the monthly tables clearing the current months table.
# m h	dom mon dow	command

PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
MAILTO=hotspot@purewhite.id.au
## NEEDS USERNAME
#@daily	        root	/root/system/install/upgrade_script.sh
@reboot         root	/usr/share/grase/www/radmin/scripts/radius_stale > /dev/null
@daily          root	/usr/share/grase/www/radmin/scripts/radius_stale > /dev/null
3 5     1,2 * * root    /usr/share/grase/www/radmin/scripts/radius_stale > /dev/null
17 5	1,2 * * root    /usr/share/grase/www/radmin/scripts/radius_monthly_acct
37 3	3 * *	root    /usr/share/grase/www/radmin/scripts/radius_old_users
@monthly	    root    /usr/share/grase/www/radmin/scripts/mirror_common_apps.sh
#30 2	* * *	root    /usr/share/grase/www/radmin/scripts/avast_mirror

@daily		    root    /usr/share/grase/www/radmin/scripts/mysql_backup
