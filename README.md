# Droid Path Finder - Installation Guide

The Droid Path Finder console application has been developed using the laravel-zero package. Following are the instructions to install the project on your computer

* Clone the repository, as mentioned below:-

* To clone the repository with HTTPS, use the following command.
```
git clone https://github.com/ali223/droid-path-finder.git
```

* To clone the repository with SSH, use the following command.
```
git clone git@github.com:ali223/droid-path-finder.git
```

* After cloning the repository, 

* Change to the folder using `cd droid-path-finder`

* Then run `composer install`

* Once the all the composer packages have been installed, you can run 
```
php application droid:find-path
```

* The output shows the droid's path map as it travels to its destination, and at the end the full path to the destination is shown. It does take it around 3 to 4 minutes to reach the destination. The example output snippet is shown below:-

```
### *  ##
##  *  ##
### *  ##
####*   #
### *  ##
### * ###
####* ###
### *####
### * ###
####* ###
Destination reached.
*********************************
Droid Path
*********************************
ffffffffffffffffffffffffffffffffffffffllfffrffffffrfffffffffffffflllfrffffffrffffrffffffllffffffffffffffffffffrfrffffffffffffffffrfrfffffffffffllllffffffffrffffffrfffffrfffffffffffllfffffffffffffffffffffffffflffffffrfffffffffllfrffffffrffffffffffffffffllffrffffffffffrfffffffffffffffffllffffrfffffffffffrffrffffffffffffffffffffllffffffffffffffrfffffffffflfffrfffflffffffffffffffffffffrffflffffffrffffffflffffffrfrffrfffllffrfrffffffffllfffffffrfrffrffffffffffffffllllfrfffffffffffffffffffrfffffffffffffffffffflffffffrfffllfrfrffffflfflffffrfffffffffffffffrffffffffffffffffffffff
```
