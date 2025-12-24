# pokedex
An interactive Pokédex view created with Laravel, with the main functionalities:
- Show of all Pokémon based on their types
- Separate page for each Pokémon that shows descriptions, abilities, a list of all moves, and stats, with a functionality to compare different Pokémon based on their stats
- A filter section that allows advanced searches in the Pokédex
## installation

- Clone the repository and run composer install inside the directory to install Laravel dependencies
- The database is deployed on PostgreSQL; restore pokedex.sql with pg_restore
- Run php artisan serve to start the Laravel server and follow the link shown by Laravel
- Add /pokedex to view the main page
