<template>
    <div v-if="ticTacToe" class="mb-5 mt-5">
        <div class="row justify-content-center">
            <h2 class="mb-5 text-center">Добро поаловать в игру <br>"крестики-нолики"</h2>
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
            <div @click="pStart('x')" class="player mr-2" :class="[playerStart == 'x' ? 'player-x shadow' : '' ]">X<span class="count">{{ ticTacToe.countX }}</span></div>
            <div @click="pStart('o')" class="player ml-2" :class="[playerStart == 'o' ? 'player-o shadow' : '' ]">O<span class="count">{{ ticTacToe.countO }}</span></div>
        </div>
        <div class="row justify-content-center  mb-2 mt-1">
            <p>{{ ticTacToe.message }}</p>
        </div>
        <div class="row justify-content-center">
            <table class="col-md-6 tic-tac-toe">
                <tbody v-if="!ticTacToe.offGame">
                    <tr v-for="(ticTac, pole) in ticTacToe.game">
                        <td v-for="(tic, position) in ticTac"   @click="go(pole, position)" class="col-md-4 td" :class="[tic == 'o' ? 'td-o' : '']">{{tic}}</td>
                    </tr>
                </tbody>
                <div v-if="ticTacToe.offGame" class="text-center off-game">
                    <p v-if="ticTacToe.offGame.win != 'НИЧЬЯ!'"><span :class="[ticTacToe.offGame.player == 'o' ? 'td-o' : '']">{{ ticTacToe.offGame.player }}</span><br>{{ ticTacToe.offGame.win }}</p>
                    <p v-else><span :class="[ticTacToe.offGame.player == 'o' ? 'td-o' : '']">{{ ticTacToe.offGame.player }}</span><span :class="[ticTacToe.offGame.computer == 'o' ? 'td-o' : '']">{{ ticTacToe.offGame.computer }}</span><br>{{ ticTacToe.offGame.win }}</p>
                </div>
            </table>
        </div>
        <div class="row justify-content-center mt-3 mb-3">
            <button @click="newGame" class="btn btn-new-game">Играть заного</button>
        </div>
    </div>
</template>
<!--1 добавить изначальную позициию для пользователя кем он играет  +-->
<!--2 занести в класс позцию пользователя определить Статус кем играет компьютер исходя из выбора пользователя +-->
<!--3 Сделать 2 логики легкая и нормальная +-->
<!--4 продумать логику чтоб в будущем реализовать в занос в пхп статистики поьзователя об выигрышах и проигрышах+-->
<!--5 при окончании игры сделать вывод победителя либо ничья +-->
<!--6 добавить кнопку после обьявления победителя 'Играть заного' +-->

<script>
    import {TicTacToeClass} from "../../store/games/ticTacToe/ticTacToeClass";
    import {  ref } from 'vue'
    export default {
        data() {
            return {
                game: [
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                ],
                options: [
                    { text: 'Легкий', value: 'easy' },
                    { text: 'Нормальный', value: 'normal' },
                ],
                complexity: 'easy',
                ticTacToe: null,
                playerStart:  'x',
                gameOn: false,
                countX: '-',
                countO: '-'
            }
        },
        async mounted() {
            this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart, this.countX, this.countO)
        },
        watch: {
            complexity: async function (e) {
                this.gameOn =  false
                this.game =  [
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                ],
                    this.playerStart = 'x'
                this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart, this.ticTacToe.countX, this.ticTacToe.countO)
            },
            playerStart: async function (e) {
                if (e == 'o') {
                    this.ticTacToe.computer = await 'x'
                    await this.ticTacToe.go('computer', 'computer')
                }
            },
        },
        methods: {
            async pStart(player) {
                if (this.gameOn) return;
                if (this.ticTacToe.offGame) return;
                if (player == 'o') this.gameOn = await true
                this.playerStart = await player
                this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart, this.ticTacToe.countX, this.ticTacToe.countO)
            },
            async go(pole, position) {
                this.gameOn = true
                if (this.game[pole][position] != null) {
                    return;
                }

                await this.ticTacToe.go(pole, position)
                // await this.ticTacToe.go('computer', 'computer')
                setTimeout(() => this.ticTacToe.go('computer', 'computer'), 300);

           },
            async newGame() {
                this.gameOn =  false
                this.game =  [
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                    {0:null, 1:null, 2:null},
                ],
                    this.complexity = 'easy'
                    this.playerStart = 'x'
                    this.ticTacToe = await new TicTacToeClass(this.game, this.complexity, this.playerStart, this.ticTacToe.countX, this.ticTacToe.countO)

            },
        }
    }
</script>

<style scoped>
    .tic-tac-toe {
        background-color: #14bdac;
    }
    .btn-new-game {
        border: 1px solid #14bdac;
        color: #14bdac;
    }
    .td {
        width: 158px;
        height: 158px;
        text-align: center;
        font-size: 100px;
    }

    .td:nth-child(even) {
            border-left: 1px solid grey;
            border-right: 1px solid grey;
    }

    tr:nth-child(2) {
            border-top: 1px solid grey;
            border-bottom: 1px solid grey;
    }

    .td-o {
        color: white;
    }

    .player {
        box-sizing: border-box;
        cursor: pointer;
        border: 1px solid #ebebeb;
        padding: 2px 20px 2px 20px;
        /*padding-left: 5px;*/
        font-size: 16px;
        font-weight: bold;
        border-radius: 6px;
        width: 160px;
        /*text-align: center;*/
        border-bottom: none;
    }
    .off-game {
        padding-top: 40px;
        width: 540px;
        height: 280px;
    }

    .off-game p {
        line-height: 80px;
        font-size: 55px;
    }
    .off-game p span {
        font-size: 100px;
    }

    .player-x {
        border-bottom: 2px solid #14bdac;;
    }
    .player-o {
        border-bottom: 2px solid #14bdac;;
    }

    .count {
        color: grey;
        margin-left: 100px;
    }
</style>
