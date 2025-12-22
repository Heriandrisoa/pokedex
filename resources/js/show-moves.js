

async function get_descri(move)
{
    let url = "http://127.0.0.1:8001/capacity/"+move;
    let req = await fetch(url);
    let res = await req.json();
    return res;
}
// deroulement capacity about

// ----------------------- //
//search
let navbar = document.querySelector('.home');
navbar.classList.add('active');

let moves = document.querySelectorAll('.capacity-container');

const search = document.querySelector("#pokemonSearch");
console.log(moves);
search.addEventListener("input", (e) => {
    moves.forEach(element => {
        let name = element.querySelector('.name-move').textContent;
        element.style.display='';
        if(!name.includes(e.target.value))
        {
            element.style.display='none';
        }
    })
});
