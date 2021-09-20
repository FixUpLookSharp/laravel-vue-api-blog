export class Normal {

    go(game, computer) {
        let bool = false;

        for (let i = game.length - 1; i >= 0; i--) {
            for (let j = 0; j <  Object.keys(game[i]).length; j++) {
                if (game[i][j] === null) {
                    game[i][j] = computer;
                    bool = true;
                    break;
                }
            }

            if (bool) {
                break;
            }
        }
        return game;
    }
}
