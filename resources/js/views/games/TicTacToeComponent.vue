<template>
    <div class="mb-5 mt-5">
        <div class="row justify-content-center">
            <h2 class="mb-5">Добро поаловать в игру "крестики-нолики"</h2>
        </div>
        <div class="row justify-content-center mb-1">
            <div class="form-group">
                <label class="pl-3">Уровень игры</label>
                <select v-model="complexity" class="form-control">
                    <option v-for="option in options" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center  mb-1">
            <div @click="pStart('x')" class="player mr-2" :class="[playerStart == 'x' ? 'player-x shadow' : '' ]">X</div>
            <div @click="pStart('o')" class="player ml-2" :class="[playerStart == 'o' ? 'player-o shadow' : '' ]">O</div>
        </div>
        <div class="row justify-content-center  mb-2">
            <p>{{ message }}</p>
        </div>
        <div class="row justify-content-center">
            <table class="col-md-6 tic-tac-toe">
<!--                <tbody>-->
<!--                    <tr v-for="(ticTac, pole) in game" :key="ticTac[pole]">-->
<!--                        <td v-for="(tic, position) in ticTac" :key="tic[position]" @click="test(pole, position)" class="col-md-4 td">{{tic}}</td>-->
<!--                    </tr>-->
<!--                </tbody>-->
                <tbody v-if="ticTacToe">
                    <tr v-for="(ticTac, pole) in ticTacToe.game">
                        <td v-for="(tic, position) in ticTac"  @click="test(pole, position, tic)" class="col-md-4 td">{{tic}}</td>
                    </tr>
                </tbody>
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <td class="col-md-4 td">x</td>-->
<!--                    <td class="td td-left-right">о</td>-->
<!--                    <td class="col-md-4 td">x</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td class="col-md-4 td td-top">x</td>-->
<!--                    <td class="col-md-4 td td-left-right td-top">о</td>-->
<!--                    <td class="col-md-4 td td-top">x</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td class="col-md-4 td td-top">x</td>-->
<!--                    <td class="col-md-4 td td-left-right td-top">о</td>-->
<!--                    <td class="col-md-4 td td-top">x</td>-->
<!--                </tr>-->
<!--                </tbody>-->
            </table>
        </div>
        <p @click="test2">
            test
        </p>
    </div>
</template>
<!--1 добавить изначальную позициию для пользователя кем он играет  +-->
<!--2 занести в класс позцию пользователя определить Статус кем играет компьютер исходя из выбора пользователя-->
<!--3 Сделать 2 логики легкая и нормальная-->
<!--4 продумать логику чтоб в будущем реализовать в занос в пхп статистики поьзователя об выигрышах и проигрышах-->
<!--5 при окончании игры сделать вывод победителя либо ничья-->
<!--6 добавить кнопку после обьявления победителя 'Играть заного'-->

<script>
    import {TicTacToeClass} from "../../store/games/ticTacToe/ticTacToeClass";
    import {  ref } from 'vue'
    export default {
        data() {
            return {
                game: [
                    [null, null, null],
                    [null, null, null],
                    [null, null, null],
                ],
                options: [
                    { text: 'Легкий', value: 'easy' },
                    { text: 'Нормальный', value: 'normal' },
                ],
                complexity: 'easy',
                ticTacToe: null,
                playerStart:  'x',
                gameOn: false,
                message: 'Начните игру или выберите игрока',
            }
        },
        async mounted() {
            this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart)
            console.log(this.ticTacToe.game)
        },
        watch: {
            complexity: async function (e) {
                this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart)
            }
        },
        methods: {
            async pStart(player) {
                if (this.gameOn) return;
                if (player == 'o') this.gameOn = await true
                this.playerStart = await player
                this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart)

            },
           async test(pole, position) {


                // console.log(this.ticTacToe.game)
                // console.log(this.ticTacToe.player)
                // console.log(this.ticTacToe.difgame)
                // console.log(this.ticTacToe.computer)
                // this.ticTacToe.go()
                // console.log(this.ticTacToe.strategy.go('adasd'))
                // console.log(this.ticTacToe.test())

               await this.ticTacToe.go(pole, position)

               await this.ticTacToe.go('computer', 'computer')

               // this.game = await this.ticTacToe.getGame
                console.log(this.ticTacToe.getGame)



           },

            test2() {
                console.log(this.game)
            }
        }
    }
</script>

<style scoped>
    .tic-tac-toe {
        background-color: #14bdac;
    }
    .td {
        width: 158px;
        height: 158px;
        text-align: center;
        font-size: 100px;
        padding-bottom: 30px;

    }
    .td-left-right {
        border-left: 1px solid #c7bebe;
        border-right: 1px solid #c7bebe;
    }
    .td-top {
        border-top: 1px solid #c7bebe;
    }

    .td-x {
        color: black;
    }

    .td-o {
        color: white;
    }

    .player {
        box-sizing: border-box;
        cursor: pointer;
        border: 1px solid #ebebeb;
        padding: 2px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 6px;
        width: 160px;
        text-align: center;
        border-bottom: none;
    }

    .player-x {
        border-bottom: 2px solid #14bdac;;
    }
    .player-o {
        border-bottom: 2px solid #14bdac;;
    }
</style>
