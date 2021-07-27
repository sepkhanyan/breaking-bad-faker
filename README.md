## Installation
### Install docker https://docs.docker.com/docker-for-windows/install/ 
- 1.Create `.env` file into project root directory
- 2.Run `cp .env.example .env`(copy .env.exmple to .env)
- 3.composer install
- 4.alias sail='bash vendor/bin/sail'
- 5.sail up
- 6.sail artisan migrate --seed

 ## Auth
- 1.`http://localhost/api/register` - registration by User Model default fields
- 2.`http://localhost/api/login` - login
- 3.`http://localhost/api/logout` - logout


 ## Endpoints
- 1.`http://localhost/api/episodes` - get all episodes
- 2.`http://localhost/api/episodes/{id}` - show episode by id
- 3.`http://localhost/api/characters` - get all characters
- 4.`http://localhost/api/characters?name={name}` - search character by name
- 5.`http://localhost/api/characters/random` - return random character
- 6.`http://localhost/api/quotes` - get all quotes
- 7.`http://localhost/api/quotes/random?author={character_name}` - random quote by character name
