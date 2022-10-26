set path=%path%;L:/git/bin/
git init
git add *
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/tristanzwart/webshop-for-mcserver.git
git push -u origin main
pause