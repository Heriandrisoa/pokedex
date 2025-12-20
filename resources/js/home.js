let navbar = document.querySelector('.home');
navbar.classList.add('active');

let pokemons = document.querySelectorAll('.pokebox');

const search = document.querySelector("#pokemonSearch");

search.addEventListener("input", (e) => {
    console.log(e.target.value);

    pokemons.forEach(element => {
    element.style.display = '';
    element.parentElement.style.display = '';

    if(!element.textContent.includes(e.target.value)){
        console.log('eeh');
        element.style.display = 'none';
        element.parentElement.style.display = 'none';
    }
})
});
