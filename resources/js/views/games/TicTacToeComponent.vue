<template>
    <div class="mb-5 mt-5">
        <div class="row justify-content-center">
            <h2 class="mb-5">Добро поаловать в игру крестики-нолики</h2>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="form-group">
                <label>Уровень игры</label>
                <select v-model="complexity" class="form-control">
                    <option v-for="option in options" v-bind:value="option.value">
                        {{ option.text }}
                    </option>
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="col-md-6 tic-tac-toe">
                <tbody>
                <tr>
                    <td class="col-md-4 td">x</td>
                    <td class="td td-left-right">о</td>
                    <td class="col-md-4 td">x</td>
                </tr>
                <tr>
                    <td class="col-md-4 td td-top">x</td>
                    <td class="col-md-4 td td-left-right td-top">о</td>
                    <td class="col-md-4 td td-top">x</td>
                </tr>
                <tr>
                    <td class="col-md-4 td td-top">x</td>
                    <td class="col-md-4 td td-left-right td-top">о</td>
                    <td class="col-md-4 td td-top">x</td>
                </tr>
                </tbody>
            </table>
        </div>
        <p @click="test">
            test
        </p>
    </div>
</template>
<!--1 добавить изначальную позициию для пользователя кем он играет-->
<!--2 занести в класс позцию пользователя определить Статус ИИ-->
<!--3 Сделать 2 логики легкая и нормальная-->
<!--4 продумать логику чтоб в будущем реализовать в занос в пхп статистики поьзователя об выигрышах и проигрышах-->
<!--5 при окончании игры сделать вывод победителя либо ничья-->
<!--6 добавить кнопку после обьявления победителя 'Играть заного'-->

<script>
    import {TicTacToeClass} from "../../store/games/ticTacToeClass";
    export default {
        data() {
            return {
                map: [
                    [0, 0, 0],
                    [1, 1, 1],
                    [2, 2, 2],
                ],
                options: [
                    { text: 'Легкий', value: 'easy' },
                    { text: 'Нормальный', value: 'normal' },
                ],
                complexity: 'easy',
                ticTacToe: null
            }
        },
        async mounted() {
            this.ticTacToe = new TicTacToeClass(this.map, this.complexity)
        },
        methods: {
            test() {
                console.log(this.ticTacToe.map)
                console.log(this.ticTacToe.difGame)
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
</style>
