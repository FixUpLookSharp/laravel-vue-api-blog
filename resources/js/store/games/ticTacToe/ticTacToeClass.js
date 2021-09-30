import {Easy} from  './easy'
import {Normal} from './normal'
export class TicTacToeClass
{
    /**
     *
     * property computer
     * property strategy
     * property offGame
     * property message
     *
     * @param game
     * @param difGame
     * @param player
     * @param countX
     * @param countO
     */
    constructor(game, difGame, player, countX, countO)
    {
        this.game = game
        this.player = player
        this.difgame = difGame
        this.offGame = false
        this.message = 'Начните игру или выберите игрока'
        this.countX = countX
        this.countO = countO
        if (player == 'o') {
            this.computer = 'x'
            this.message = 'Ходит Х'

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
            this.message = 'Ходит ' + this.player
           await this.computerWinnerLogic()
        } else {
            if (this.offGame) return;
            this.message = 'Ходит ' + this.computer
            if (this.game[str][column] === null) {
                this.game[str][column] = this.player
            }
            await this.playerWinnerLogic()
        }

        const allItemsHaveValue = await this.game.map(o => Object.values(o).every(v => v)).every(v => v);

        if (allItemsHaveValue && !this.offGame) {
            this.message = 'Игра окончена!'
            this.offGame = {player: this.player, computer: this.computer, win: 'НИЧЬЯ!'}
            await this.gameIsOver()
        }
    }

    async gameIsOver()
    {
        return await this.offGame
    }


    countWin(win)
    {
        if (win == 'x') {
            if (this.countX == '-') {
                this.countX = 1
            } else  {
                this.countX += 1
            }
        } else {
            if (this.countO == '-') {
                this.countO = 1
            } else  {
                this.countO += 1
            }
        }
    }

    async playerWinnerLogic()
    {
        if (this.game[0][0] == this.player && this.game[0][1] == this.player && this.game[0][2] == this.player
            || this.game[1][0] == this.player && this.game[1][1] == this.player && this.game[1][2] == this.player
            || this.game[2][0] == this.player && this.game[2][1] == this.player && this.game[2][2] == this.player
            || this.game[0][0] == this.player && this.game[1][0] == this.player && this.game[2][0] == this.player
            || this.game[0][1] == this.player && this.game[1][1] == this.player && this.game[2][1] == this.player
            || this.game[0][2] == this.player && this.game[1][2] == this.player && this.game[2][2] == this.player
            || this.game[0][0] == this.player && this.game[1][1] == this.player && this.game[2][2] == this.player
            || this.game[0][2] == this.player && this.game[1][1] == this.player && this.game[2][0] == this.player) {


            this.countWin(this.player)
            this.message = 'Игра окончена!'
            this.offGame = {player: this.player, win: 'ПОБЕДИТЕЛЬ!'}
            await this.gameIsOver()
        }
    }

    async computerWinnerLogic()
    {
        if (this.game[0][0] == this.computer && this.game[0][1] == this.computer && this.game[0][2] == this.computer
            || this.game[1][0] == this.computer && this.game[1][1] == this.computer && this.game[1][2] == this.computer
            || this.game[2][0] == this.computer && this.game[2][1] == this.computer && this.game[2][2] == this.computer
            || this.game[0][0] == this.computer && this.game[1][0] == this.computer && this.game[2][0] == this.computer
            || this.game[0][1] == this.computer && this.game[1][1] == this.computer && this.game[2][1] == this.computer
            || this.game[0][2] == this.computer && this.game[1][2] == this.computer && this.game[2][2] == this.computer
            || this.game[0][0] == this.computer && this.game[1][1] == this.computer && this.game[2][2] == this.computer
            || this.game[0][2] == this.computer && this.game[1][1] == this.computer && this.game[2][0] == this.computer) {

            this.countWin(this.computer)
            this.message = 'Игра окончена!'
            this.offGame = {player: this.computer, win: 'ПОБЕДИТЕЛЬ!'}
            await this.gameIsOver()
        }
    }


}
