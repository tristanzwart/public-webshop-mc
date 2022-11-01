set path=%path%;L:/git/bin/
@echo off
set /p commitmsg=commit bericht: 
git add *
git commit -a -m "%commitmsg%"