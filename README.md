Create a database named employee_management
open project in vs code and open terminal

run cp .env.example .env if the file doesnt exists


#Update composer packages 

run composer update

#update javascript packages

run npm install

#Create an application key

RUN php artisan key:generate

#Serve the Application
RUN php artisan serve