git add --all
git commit -m "$1"
git pull
git push
if $2
then
    git push heroku master
fi


