# DashMaxPi

** **Currently Unfinished** **

A lighttpd PHP dashboard for the raspberry pi.

This is a small dhasboard that lets you see the status of services running on your Raspberry Pi. Simply set a username and password to access the dashboard and then add the names of the services you wish to keep track of. It also shows the ping time from your RPI to google.com.

##Login Screen
You set your username and password in the config file.
//includes/config/config.php

**NOTE**
For security you will store an encrypted hash of your password in the config file. To do this you must go to /createPassword.php in your browser. You can then enter the password you would like to use and it will give you the hashed password you must store in the config file. It also shows you an example of what your config file should look like..

![dmpi-login](https://cloud.githubusercontent.com/assets/13204104/12538373/56be9a1e-c2a6-11e5-8f29-ec09df2ff200.png)

##Status Screen
This screen shows you the status of the services you have set to watch. There is a wrench button in the upper right corner of the box that allows you to add or remove services. This status box also shows the ping time to google.com.

**NOTE**
Ping time shown may not be the most accurate. It runs a ping and then if the time is less than 20ms it will display that time.
If the initial ping is greater than 20 seconds it will perform 2 more tests and use the lowest value of the 3. This is done because I found Google tended to throw out a terribly slow ping oonce in a while which threw off any averages that could be determined without far more ping tests.

![dmpi-status](https://cloud.githubusercontent.com/assets/13204104/12538379/6669a3e6-c2a6-11e5-95af-21a8fffeeb85.png)

##Add/Remove Services
To add and remove services there are 2 modals.These can be accessed using the wrench button in the upper right of the status box on the status page.
Simply type in the name of the service using the form and submit and the list will be updated.

###serviceList.txt
This uses no database so when you add services or remove services they are written to a text file.
/includes/config/serviceList.txt

![dmpi-addservice](https://cloud.githubusercontent.com/assets/13204104/12538407/ef939924-c2a6-11e5-95ea-993ce19997f8.png)

##Config Example
/includes/config/config.php

    <?php

        $mainConfig = (object)[
            'username'      =>  'admin',
            'password'      =>  '$2y$10$0/EiTIHdfkZFonAes3lHxuqOv6f64gzfD3BFrwTbq98EBu3lA00Rq',
            'enable_ping'   =>  true
        ];
    
    ?>
