-- SQL (PostgreSQL): repartir propre
DROP TABLE IF EXISTS poke_profile;
DROP TABLE IF EXISTS poke_stats;
DROP TABLE IF EXISTS pokedex;

-- 1) Table principale (core)
CREATE TABLE pokedex (
  pokedex_number INT PRIMARY KEY,
  pokemon_name   TEXT NOT NULL UNIQUE,
  type_1         TEXT NOT NULL,
  type_2         TEXT,

  primary_color  TEXT,
  shape          TEXT,
  generation     INT,

  is_default        BOOLEAN,
  baby_pokemon      BOOLEAN,
  alolan_form       BOOLEAN,
  galarian_form     BOOLEAN,
  forms_switchable  BOOLEAN,
  mega_evolution    BOOLEAN,

  legendary      BOOLEAN,
  mythical       BOOLEAN,
  genderless     BOOLEAN,
  female_rate    NUMERIC,

  can_evolve       BOOLEAN,
  evolves_from     TEXT,        -- ✅ TEXTE
  final_evolution  BOOLEAN
);

-- 2) Stats
CREATE TABLE poke_stats (
  pokedex_number INT PRIMARY KEY
    REFERENCES pokedex(pokedex_number) ON DELETE CASCADE,

  hit_points        INT,
  attack            INT,
  defense           INT,
  special_attack    INT,
  special_defense   INT,
  speed             INT,

  total_stats        INT,
  mean               NUMERIC,
  standard_deviation NUMERIC,

  capture_rate     INT,
  base_happiness   INT,

  base_experience    INT,
  exp_type           TEXT,
  exp_to_level_100   BIGINT
);

-- 3) Profil
CREATE TABLE poke_profile (
  pokedex_number INT PRIMARY KEY
    REFERENCES pokedex(pokedex_number) ON DELETE CASCADE,

  ability_1       TEXT,
  ability_2       TEXT,
  hidden_ability  TEXT,

  height  NUMERIC,
  weight  NUMERIC,
  bmi     NUMERIC,

  genus       TEXT,
  egg_group_1 TEXT,
  egg_group_2 TEXT,
  egg_cycles  INT
);

-- 4) Migration: d'abord pokedex (sinon FK cassent)
INSERT INTO pokedex (
  pokedex_number, pokemon_name, type_1, type_2,
  primary_color, shape, generation,
  is_default, baby_pokemon, alolan_form, galarian_form, forms_switchable, mega_evolution,
  legendary, mythical, genderless, female_rate,
  can_evolve, evolves_from, final_evolution
)
SELECT
  pokedex_number,
  pokemon_name,
  type_1,
  NULLIF(type_2, '') AS type_2,
  primary_color, shape, generation,
  is_default, baby_pokemon, alolan_form, galarian_form, forms_switchable, mega_evolution,
  legendary, mythical, genderless, female_rate,
  can_evolve,
  NULLIF(evolves_from, '') AS evolves_from,   -- ✅ garde texte, vide -> NULL
  final_evolution
FROM pokedex_old;

-- 5) Migration stats
INSERT INTO poke_stats (
  pokedex_number,
  hit_points, attack, defense, special_attack, special_defense, speed,
  total_stats, mean, standard_deviation,
  capture_rate, base_happiness,
  base_experience, exp_type, exp_to_level_100
)
SELECT
  pokedex_number,
  hit_points, attack, defense, special_attack, special_defense, speed,
  total_stats, mean, standard_deviation,
  capture_rate, base_happiness,
  base_experience, exp_type, exp_to_level_100
FROM pokedex_old;

-- 6) Migration profil
INSERT INTO poke_profile (
  pokedex_number,
  ability_1, ability_2, hidden_ability,
  height, weight, bmi,
  genus, egg_group_1, egg_group_2, egg_cycles
)
SELECT
  pokedex_number,
  ability_1, ability_2, hidden_ability,
  height, weight, bmi,
  genus, egg_group_1, egg_group_2, egg_cycles
FROM pokedex_old;

-- 7) Vérif
SELECT COUNT(*) AS old_count FROM pokedex_old;
SELECT COUNT(*) AS new_count FROM pokedex;
SELECT COUNT(*) AS stats_count FROM poke_stats;
SELECT COUNT(*) AS profile_count FROM poke_profile;
-- SQL (PostgreSQL): repartir propre
DROP TABLE IF EXISTS poke_profile;
DROP TABLE IF EXISTS poke_stats;
DROP TABLE IF EXISTS pokedex;

-- 1) Table principale (core)
CREATE TABLE pokedex (
  pokedex_number INT PRIMARY KEY,
  pokemon_name   TEXT NOT NULL UNIQUE,
  type_1         TEXT NOT NULL,
  type_2         TEXT,

  primary_color  TEXT,
  shape          TEXT,
  generation     INT,

  is_default        BOOLEAN,
  baby_pokemon      BOOLEAN,
  alolan_form       BOOLEAN,
  galarian_form     BOOLEAN,
  forms_switchable  BOOLEAN,
  mega_evolution    BOOLEAN,

  legendary      BOOLEAN,
  mythical       BOOLEAN,
  genderless     BOOLEAN,
  female_rate    NUMERIC,

  can_evolve       BOOLEAN,
  evolves_from     TEXT,        -- ✅ TEXTE
  final_evolution  BOOLEAN
);

-- 2) Stats
CREATE TABLE poke_stats (
  pokedex_number INT PRIMARY KEY
    REFERENCES pokedex(pokedex_number) ON DELETE CASCADE,

  hit_points        INT,
  attack            INT,
  defense           INT,
  special_attack    INT,
  special_defense   INT,
  speed             INT,

  total_stats        INT,
  mean               NUMERIC,
  standard_deviation NUMERIC,

  capture_rate     INT,
  base_happiness   INT,

  base_experience    INT,
  exp_type           TEXT,
  exp_to_level_100   BIGINT
);

-- 3) Profil
CREATE TABLE poke_profile (
  pokedex_number INT PRIMARY KEY
    REFERENCES pokedex(pokedex_number) ON DELETE CASCADE,

  ability_1       TEXT,
  ability_2       TEXT,
  hidden_ability  TEXT,

  height  NUMERIC,
  weight  NUMERIC,
  bmi     NUMERIC,

  genus       TEXT,
  egg_group_1 TEXT,
  egg_group_2 TEXT,
  egg_cycles  INT
);

-- 4) Migration: d'abord pokedex (sinon FK cassent)
INSERT INTO pokedex (
  pokedex_number, pokemon_name, type_1, type_2,
  primary_color, shape, generation,
  is_default, baby_pokemon, alolan_form, galarian_form, forms_switchable, mega_evolution,
  legendary, mythical, genderless, female_rate,
  can_evolve, evolves_from, final_evolution
)
SELECT
  pokedex_number,
  pokemon_name,
  type_1,
  NULLIF(type_2, '') AS type_2,
  primary_color, shape, generation,
  is_default, baby_pokemon, alolan_form, galarian_form, forms_switchable, mega_evolution,
  legendary, mythical, genderless, female_rate,
  can_evolve,
  NULLIF(evolves_from, '') AS evolves_from,   -- ✅ garde texte, vide -> NULL
  final_evolution
FROM pokedex_old;

-- 5) Migration stats
INSERT INTO poke_stats (
  pokedex_number,
  hit_points, attack, defense, special_attack, special_defense, speed,
  total_stats, mean, standard_deviation,
  capture_rate, base_happiness,
  base_experience, exp_type, exp_to_level_100
)
SELECT
  pokedex_number,
  hit_points, attack, defense, special_attack, special_defense, speed,
  total_stats, mean, standard_deviation,
  capture_rate, base_happiness,
  base_experience, exp_type, exp_to_level_100
FROM pokedex_old;

-- 6) Migration profil
INSERT INTO poke_profile (
  pokedex_number,
  ability_1, ability_2, hidden_ability,
  height, weight, bmi,
  genus, egg_group_1, egg_group_2, egg_cycles
)
SELECT
  pokedex_number,
  ability_1, ability_2, hidden_ability,
  height, weight, bmi,
  genus, egg_group_1, egg_group_2, egg_cycles
FROM pokedex_old;

-- 7) Vérif
SELECT COUNT(*) AS old_count FROM pokedex_old;
SELECT COUNT(*) AS new_count FROM pokedex;
SELECT COUNT(*) AS stats_count FROM poke_stats;
SELECT COUNT(*) AS profile_count FROM poke_profile;

