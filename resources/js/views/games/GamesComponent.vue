<template>
    <div class="row mt-5 mb-5 text-center">
            <div class="col-md-4">
                <router-link class="tic-tac-toe" :to="{name: 'tic-tac-toe'}">
                    <p>Крестики нолики</p>
                    <img class="shadow rounded game" height="250" width="250" src="/images/games/tictactoe.jpg">
                </router-link>
            </div>
        <div class="col-md-4">
            <p>Угадай число</p>
            <img class="shadow rounded game" height="250" width="250" src="/images/games/guess_number.jpg">
        </div>
        <div class="col-md-4">
            <p>Морской бой</p>
            <img class="shadow rounded game" height="250" width="250" src="/images/games/sea_battle.jpg">
        </div>
    </div>
</template>

<script>
    export default {
        name: "GamesComponents"
    }
</script>

<style scoped>
    .tic-tac-toe {
        text-decoration: none;
    }

    .game:hover {
        border: 1px solid whitesmoke;
    }
</style>
