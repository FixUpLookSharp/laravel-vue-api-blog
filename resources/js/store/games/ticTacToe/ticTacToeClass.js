import {Easy} from  './easy'
import {Normal} from './normal'
export class TicTacToeClass
{
    /**
     *
     * property computer
     * property strategy
     * property offGame
     *
     * @param game
     * @param difGame
     * @param player
     */
    constructor(game, difGame, player)
    {
        this.game = game
        this.player = player
        this.difgame = difGame
        this.offGame = false
        if (player == 'o') {
            this.computer = 'x'
        } else if (player == 'x') {
            this.computer = 'o'
        }

        if (difGame == 'easy') {
            this.strategy =  new Easy()
        } else if (difGame == 'normal') {
            this.strategy =  new Normal()
        }
    }

    async go(str, column)
    {
        if (this.offGame) return;

        if (str === 'computer' && column === 'computer') {
            this.game = await this.strategy.go(this.game, this.computer);

            if (this.game[0][0] == this.computer && this.game[0][1] == this.computer && this.game[0][2] == this.computer
            || this.game[1][0] == this.computer && this.game[1][1] == this.computer && this.game[1][2] == this.computer
            || this.game[2][0] == this.computer && this.game[2][1] == this.computer && this.game[2][2] == this.computer
            || this.game[0][0] == this.computer && this.game[1][0] == this.computer && this.game[2][0] == this.computer
            || this.game[0][1] == this.computer && this.game[1][1] == this.computer && this.game[2][1] == this.computer
            || this.game[0][2] == this.computer && this.game[1][2] == this.computer && this.game[2][2] == this.computer
            || this.game[0][0] == this.computer && this.game[1][1] == this.computer && this.game[2][2] == this.computer
            || this.game[0][2] == this.computer && this.game[1][1] == this.computer && this.game[2][0] == this.computer) {
                this.offGame = await 'Компьютер выиграл!'
                await this.gameIsOver()
            }
        } else {
            if (this.offGame) return;

            if (this.game[str][column] === null) {
                this.game[str][column] = this.player
            }
            if (this.game[0][0] == this.player && this.game[0][1] == this.player && this.game[0][2] == this.player
            || this.game[1][0] == this.player && this.game[1][1] == this.player && this.game[1][2] == this.player
            || this.game[2][0] == this.player && this.game[2][1] == this.player && this.game[2][2] == this.player
            || this.game[0][0] == this.player && this.game[1][0] == this.player && this.game[2][0] == this.player
            || this.game[0][1] == this.player && this.game[1][1] == this.player && this.game[2][1] == this.player
            || this.game[0][2] == this.player && this.game[1][2] == this.player && this.game[2][2] == this.player
            || this.game[0][0] == this.player && this.game[1][1] == this.player && this.game[2][2] == this.player
            || this.game[0][2] == this.player && this.game[1][1] == this.player && this.game[2][0] == this.player) {
                this.offGame = await 'Вы выиграли!'
                await this.gameIsOver()
            }
        }

        const allItemsHaveValue = await this.game.map(o => Object.values(o).every(v => v)).every(v => v);

        if (allItemsHaveValue) {
            this.offGame = await 'Ничья'
            await this.gameIsOver()
        }
    }

    async gameIsOver()
    {
        return await this.offGame
    }

    get getGame() {
        return this.fullGame();
    }

    fullGame() {
        return this.game
    }


}
