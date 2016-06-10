# SentinelData
a script intended for use with Hard Disk Sentinel to collect temperature and health data from multiple computers

The idea for this short code came to me a few years ago. I was and still am using a few Windows based PCs with many hard
drives and no backup. For that reason I had/have Hard Disk Sentinel on all of those machines. It was problematic to see
all the data from headless machines. Sentinel has a neat feature to serve a page with all the relevant informations on a
local network, but that page has too much details for my needs, so this code filters data from all machines and shows most 
relevant data in small table. The webserver is on a Raspberry PI, which is further connected to a small screen that serves
all data in one place. 

The code filters out and serves computer name, local IP address, uptime and aquistion date/time for every PC in local 
network which has Sentinel installed, it further shows partition labels, hard disk model, temperature and health for every 
hard disk in all the computers.

Seeing the health deterioration as soon as it happens helped me rescue data from two hard drives in last few years, so I 
hope that it may help some of you too. 

This solution cannot help with hard disk sudden death, spindle problems and similar, but in a case of bad blocks and similar 
it may singal early enough to give you enough time to transfer all the data to another disk. Main use in my case is to
follow the temperatures and see when the time comes to clean the air filters. 
