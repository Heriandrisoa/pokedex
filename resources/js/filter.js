let colors = {
    Ice: '#B3C2F2',
    Water: '#5E82F7',
    Grass: '#97DB4F',
    Dragon: '#a13d3dff',
    Fairy: '#ff9191ff',
    Normal: '#cacfd8ff',
    Electric: '#f3ff4cff',
    Psychic: '#ff0080ff',
    Bug: '#0c6900ff',
    Fire: '#ff9900ff',
    Poison: '#9720a7ff',
    Steel: '#646464ff',
    Fighting: '#eb0303ff',
    Dark: '#312727ff',
    Ground: '#9b5a2ec0',
    Ghost: '#000000ff',
    Rock: '#682a00ff',
    Flying: '#1190afff'
};

let text_colors = {
    Ice: '#111827',
    Water: '#111827',
    Grass: '#111827',
    Dragon: '#FFFFFF',
    Fairy: '#111827',
    Normal: '#111827',
    Electric: '#111827',
    Psychic: '#FFFFFF',
    Bug: '#FFFFFF',
    Fire: '#111827',
    Poison: '#FFFFFF',
    Steel: '#FFFFFF',
    Fighting: '#FFFFFF',
    Dark: '#FFFFFF',
    Ground: '#FFFFFF',
    Ghost: '#FFFFFF',
    Rock: '#FFFFFF',
    Flying: '#111827'
};

class Pokemon{
    constructor(pokeId, name, type1, type2, stats)
    {
        this.pokeId = pokeId;
        this.type1 = type1;
        this.type2 = type2;
        this.stats = stats;
        this.ratio = pokeId;
        this.showable = true;
    }
}

let global_box = document.querySelector('.global-box');
global_box.innerHTML = '';

let pokemons = [];

async function get_stats(id)
{
    const res = await fetch('/api/'+id +'/stats');
    const data = await res.json();
    return data;
}

async function init_pokemons()
{
    let res = await fetch('/api/pokedex');
    let brut_pokemons = await res.json();
    for (const pokemon of brut_pokemons) {
        let stat = await get_stats(pokemon.pokedex_number);
        let p = new Pokemon(pokemon.pokedex_number, pokemon.pokemon_name, pokemon.type_1, pokemon.type_2, stat[0]);
        console.log(p.stat);
    }
}

function show_pokemons() {
    global_box.innerHTML = '';

    pokemons.forEach(pokemon => {
        const color1 = colors[pokemon.type1] || '#ccc';
        const color2 = colors[pokemon.type2] || color1;
        const textColor = text_colors[pokemon.type1] || '#000';

        const a = document.createElement('a');
        a.href = `/pokedex/${pokemon.pokeId}`;
        a.className = 'btn';

        const div = document.createElement('div');
        div.className = 'pokebox';
        div.style.setProperty('--type-1', color1);
        div.style.setProperty('--type-2', color2);
        div.style.setProperty('--color', textColor);

        const pName = document.createElement('p');
        pName.textContent = pokemon.name;

        const img = document.createElement('img');
        img.src = `/sprite/${pokemon.name}.gif`;

        const type1 = document.createElement('p');
        type1.className = 'type1';
        type1.style.display = 'none';
        type1.textContent = pokemon.type1;

        const type2 = document.createElement('p');
        type2.className = 'type2';
        type2.style.display = 'none';
        type2.textContent = pokemon.type2 || '';

        // assembler
        div.append(pName, img, type1, type2);
        a.appendChild(div);
        global_box.appendChild(a);
    });
}

init_pokemons();
// show_pokemons();

// let type1 = document.getElementById('type1');
// let type2 = document.getElementById('type2');
// let operator = document.getElementById('operator');
// // let pokemons = document.querySelectorAll('.pokebox');

// const possible_type = [
//   "Ice","Water","Grass","Dragon","Fairy","Normal",
//   "Electric","Psychic","Bug","Fire","Poison","Steel",
//   "Fighting","Dark","Ground","Ghost","Rock","Flying"
// ];

// //type filter
// function filter_type() {

//     let a = type1.value.trim();
//     let b = type2.value.trim();
//     let isAValid = possible_type.includes(a);
//     let isBValid = possible_type.includes(b);

//     pokemons.forEach(pokemon => {
//         let poketype1 = pokemon.querySelector('.type1').textContent.trim();
//         let poketype2 = pokemon.querySelector('.type2').textContent.trim();


//         // exception for pokemon with only one type
//         if(!possible_type.includes(poketype2))
//         {
//             poketype2 = poketype1;
//         }
//         //

//         let matchA = isAValid ? poketype1.includes(a) : false;
//         let matchB = isBValid ? poketype2.includes(b) : false;

//         let shouldShow = true;

//         // operator rules
//         if (operator.value === "and") {
//             if (isAValid && isBValid) {
//                 shouldShow = matchA && matchB;
//             } else if (isAValid) {
//                 shouldShow = matchA;
//             } else if (isBValid) {
//                 shouldShow = matchB;
//             }
//         }

//         if (operator.value === "or") {
//             if (isAValid || isBValid) {
//                 shouldShow = matchA || matchB;
//             }
//         }

//         pokemon.style.display = shouldShow ? "" : "none";
//         pokemon.parentElement.style.display = shouldShow ? "" : "none";
//     });
// }


// function order_by_ratio(ratio)
// {
    
// }
// type1.addEventListener("change", filter_type);
// type2.addEventListener("change", filter_type);
// operator.addEventListener("change", filter_type);


// //  ----------------------------  //
// //        compare stats           //
// //  ---------------------------   //            



// let data = (await get_stats(2))[0];
// console.log(data);

// // récupérer toutes les checkbox du groupe
// const checkboxes = document.querySelectorAll('input[name="stat"]');

// checkboxes.forEach(cb => {
//   cb.addEventListener('change', (e) => {

//     const ratio = Array.from(checkboxes)
//                          .filter(c => c.checked)
//                          .map(c => c.value);

    
//   });
// });

