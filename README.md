<h1>PHOTOAPY</h1><hr>
<h2>System Prerequisites</h2>

<p><b>You need to have:</b></p>
<ul>
    <li>docker installed</li>
    <li>composer installed</li>
    <li>A code editor of your choice</li>
    <li>WLS enabled</li>
    <li>Ubutu terminal or other compatible</li>
    <li>postman installed</li>
</ul><br>

<h2>Steps to run the project</h2>

<h3>Step One</h3>

<p>You need to clone the repository on your computer, as we use docker, it has to be in the linux section on your computer, if you don't know which folder is enabled, open your terminal, there it tells you the name of the root folder, if you want to use one of those inside that folder then put the following command:</p>
<p>cd foldername</p>
<p>Once you are in your chosen folder put the following command in your terminal</p>
<p>git clone https://github.com/Yolimarisol/photoapy.git</p>

<h3>Step Two</h3>
<p>You need to install the necessary dependencies for this enter your project folder in your terminal with the command</p>
<p>cd photoapy</p>
<p>Download the dependencies with the command:</p>
<p>composer install</p>
<p>We also need to install the NPM dependencies defined in the package.json file with:</p>
<p>npm install</p>
<h3>Step Three</h3>
<p>You need to configure your .env file for this you can copy the .env.example</p>
<p>In your .env you need to place your DB_USERNAME and DB_PASSWORD sail by
  default uses 'sail' and 'password'. Also for the use of password reset
You need to change the MAIL_PORT to 587
MAIL_USERNAME for your email
MAIL_PASSWORD for the password for the application that your email gives you
and MAIL_ENCRYPTIOM by tls</p>
<p>and finally generate your APP_KEY for it use the following command</p>
<p>./vendor/bin/sail artisan key:generate</p>
<h3>Step Four</h3>
<p>In case sail has not been installed correctly you can use the following command</p>
<p>composer require laravel/sail --dev</p>
<p>and after</p>
<p>php artisan sail:install</p>
<p>./vendor/bin/sail up</p>
<p>And repeat the command to generate the key</p>
<h3>Step Five</h3>
<p>
Run the migrations with data seeding with the command:</p>
<p>./vendor/bin/sail artisan migrate:fresh --seed</p>
<h3>Step Six</h3>
<p>You can try the api in postman for this I share the following collection</p>
<p><a> https://grey-moon-690845.postman.co/workspace/Team-Workspace~27275328-b5af-4d65-823a-1a9b34e5c4e5/collection/26853360-371d5b08-e618-4fa1-90c6-2b067522cf7e?action=share&creator=26853360 </a></p>


