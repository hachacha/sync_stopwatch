# synced stopwatch
Basic program that uses a database for a stopwatch that multiple people can use at the same time if connected to that server.
The database is queried with javascript every 100ms but relies on the database's time in order for everyone to be on track 
*(or at least withint 100ms of one another (which is good enough for the original purpose of this))*
Created for [Josh of ICE](https://www.iceorg.org/joshua-rubin/)
[used this guide](https://askubuntu.com/questions/330802/how-can-i-make-my-laptop-a-server-for-the-intranet) in order to make it so the program can be accessed offline.

### future:
+ multiple timers
+ show number of people connected
+ count down from specific time instead of up