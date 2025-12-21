

async function get_descri(move)
{
    let url = "http://127.0.0.1:8001/capacity/"+move;
    let req = await fetch(url);
    let res = await req.json();
    return res;
}
// deroulement capacity about

document.querySelectorAll(".capacity-link").forEach(button => {
    button.addEventListener("click", async () => {
        const container = button.closest(".capacity-container");
        container.classList.toggle("open");

        let move = container.querySelector('.name-move').textContent;
        let descri =await get_descri(move);
        let pp = container.querySelector('.pp');
        let description = container.querySelector('.description-moves');
        console.log(descri.pp);
        pp.innerHTML = `<strong>pp: </strong> ${descri.pp}`;
        description.innerHTML = `<strong>description: </strong> ${descri.description}`;
        
        let who_else = container.querySelector('a');
        who_else.setAttribute('href', '/who-got/capacity/' + move);
    });
});

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
