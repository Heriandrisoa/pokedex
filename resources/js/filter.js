let navbar = document.querySelector('.filter .nav-link');
console.log(navbar);
navbar.classList.add('active');
class PokedexTypeFilter {
    constructor() {
        this.type1Select = document.getElementById('type1');
        this.type2Select = document.getElementById('type2');
        this.operatorSelect = document.getElementById('operator');

        this.cards = Array.from(document.querySelectorAll('.pokebox'));

        this.validTypes = new Set([
            "Ice","Water","Grass","Dragon","Fairy","Normal",
            "Electric","Psychic","Bug","Fire","Poison","Steel",
            "Fighting","Dark","Ground","Ghost","Rock","Flying"
        ]);

        this.bindEvents();
    }

    bindEvents() {
        this.type1Select.addEventListener('change', () => this.apply());
        this.type2Select.addEventListener('change', () => this.apply());
        this.operatorSelect.addEventListener('change', () => this.apply());
    }

    getSelectedTypes() {
        const t1 = this.type1Select.value;
        const t2 = this.type2Select.value;

        return {
            t1: this.validTypes.has(t1) ? t1 : null,
            t2: this.validTypes.has(t2) ? t2 : null
        };
    }

    getPokemonTypes(card) {
        let type1 = card.querySelector('.type1').textContent.trim();
        let type2 = card.querySelector('.type2').textContent.trim();

        // mono-type Pokémon → duplicate type
        if (!this.validTypes.has(type2)) {
            type2 = type1;
        }

        return { type1, type2 };
    }

    matchesAND(pokemonTypes, selected) {
        if (selected.t1 && selected.t2) {
            return (
                pokemonTypes.type1 === selected.t1 &&
                pokemonTypes.type2 === selected.t2
            );
        }

        if (selected.t1) return pokemonTypes.type1 === selected.t1;
        if (selected.t2) return pokemonTypes.type2 === selected.t2;

        return true;
    }

    matchesOR(pokemonTypes, selected) {
        if (!selected.t1 && !selected.t2) return true;

        return (
            pokemonTypes.type1 === selected.t1 ||
            pokemonTypes.type2 === selected.t2 ||
            pokemonTypes.type1 === selected.t2 ||
            pokemonTypes.type2 === selected.t1
        );
    }

    apply() {
        const selected = this.getSelectedTypes();
        const operator = this.operatorSelect.value;

        this.cards.forEach(card => {
            const pokemonTypes = this.getPokemonTypes(card);

            let visible = true;

            if (operator === 'and') {
                visible = this.matchesAND(pokemonTypes, selected);
            } else {
                visible = this.matchesOR(pokemonTypes, selected);
            }

            card.style.display = visible ? '' : 'none';
            card.parentElement.style.display = visible ? '' : 'none';
        });
    }
}

/* init */
document.addEventListener('DOMContentLoaded', () => {
    new PokedexTypeFilter();
});
