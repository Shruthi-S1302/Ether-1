Hello! This is the README.md page of Ether - The Blogging Website.

-----------------------------------------------------------------------------------------

This project was created by Susindhar Arumugapriya Venkatesan, Shruthi S, Harikrishna
Ramesh and Reuben Manoj. This project was created as a part of our Project
requirements for the course, CSE3002 - Internet and Web Programming, guided by
Dr. Rajkumar S at Vellore Institute of Technology, Chennai.

Below you will find details of the project, including how to run it and access it.
If you wish to improve this project, or help us correct our mistakes if any, do
feel free to contact us by our email! Our emails are given below:

                   *  *  *  *  *  *  *

Susindhar Arumugapriya Venkatesan - susindhar.av2020@vitstudent.ac.in
Shruthi S - shruthi.s2020a@vitstudent.ac.in
Harikrishna Ramesh - harikrishna.r2020@vitstudent.ac.in
Reuben Manoj - reuben.manoj2020@vitstudent.ac.in

                   *  *  *  *  *  *  *

We hope you find this README.md useful. Happy Reading! :D

-----------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------

# Experimental Setup

The minimum hardware specifications needed by a computer to properly access our project
is as follows:

System - Pentium IV 2.4 GHz
Hard Disk - 40 GB
RAM - 256 MB

The minimum software specifications needed by a computer to properly access our project
is as follows:
Operating System - Any Windows OS/ MacOS/ Linux.
Client Software - Any Web browser.
Communication Network - Internet.

# What this folder contains

Let us show you around the project folder, so you can know what is what. Now, you
will find six sub-folders, ten .php files, one .sql file and this README.md file.
Those .php files are part of our webpage. The .sql file is used to configure our
database, which we need to set up this project. We'll see about that in the next
topic. Let us see what the sub-folders look like:

    > images - This folder contains all the images uploaded by us and the user
    for their profiles.

    > config - This sub-folder contains the configuration that connects the
    front-end with the back-end. The front-end is connected to the backend via
    PDOs in some pages, which you can find in pdo.php. The signout.php file ends
    the login session.

Furthermore, you can click on any file to view the code here in the main workspace.
The files are indented properly and heavily commented, so you can read and
understand what each line of code does to that webpage. Feel free to browse the
comments if you do not know what a piece of code is for.

# How to set up this project

You need to install XAMPP, a local server software that lets you host a website
with your own computer as a web-server. However, only you can access that website.
It is typically used by web programmers for testing their web applications before
deployment. You can download XAMPP from the website through the link  below:

https://www.apachefriends.org/download.html

Next, when it is done installing (no need of special stuff, go through a normal
installation and it should be working fine), open the XAMPP Control Panel. Start
the Apache Tomcat server and MySQL server. The background for their words should turn
yellow and then green. It means you're good to go. But first, to view our project,
extract the files in this zip file into a single folder, and name it (preferably 
Carbnb, come on). Now, if you have undergone the installations without specifications,
your XAMPP folder will be located in this path:

C:/xampp

You can go to C:, choose xampp folder, and go to htdocs folder. Now, paste that folder
that you stored the extracted files in, into this folder. We're not done yet.

Go to your default web browser (hopefully not IE, grandpa), and type in:
localhost/phpmyadmin

You will find a page appear. This is your database access module. You can see the values
that are stored and retreived, in this page. Now, in the right panel, click new. Name
your new database, 'ether'. Please don't change the name, it is important. Now, go to
the import tab, and click import file. Now, from the folder that we extracted (not
necessarily the one we pasted in htdocs), select ether.sql (which is the database query
dump file) and click OK.

Your database is setup. Your front-end is setup. You're all set!

Now access the website by typing in localhost/ether [or whatever name you gave that
folder in htdocs]. You should see the index page! :D

------------------------------------------------------------------------------------------

# Help us Improve

As we said before, you can always contact us if you have any feedback (both good and the
bad ones), suggestions to improve, and how best we can go about it. Help us get better!
You can reach us at any of the following email addresses:

                   *  *  *  *  *  *  *

Susindhar Arumugapriya Venkatesan - susindhar.av2020@vitstudent.ac.in
Shruthi S - shruthi.s2020a@vitstudent.ac.in
Harikrishna Ramesh - harikrishna.r2020@vitstudent.ac.in
Reuben Manoj - reuben.manoj2020@vitstudent.ac.in

                   *  *  *  *  *  *  *

This brings us to the end of our README.md file. Good luck exploring the project! :D

------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------
