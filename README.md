# pokedex
an interactive pokedex view created with laravel, with main functionnality:
- show of all pokemons based on their types
- separated page for each pokemons that shows descriptions,, abilities  list of all moves, and stats, with a functionnality to compare different pokemons based on their stats
- a filter rubrique that allows to do some advanced search on the pokedex

# installation 
- clone the repository and run composer install inside the directory for laravel dependencies
- the databases is deployed on postgresql, restore pokedex.sql with pg_restore 
- run php artisan serve to run the laravel server and follow the link shown by laravel
- add /pokedex to view the main page
