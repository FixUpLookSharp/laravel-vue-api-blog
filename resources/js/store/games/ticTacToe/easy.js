export class Easy {

    go(game, computer) {
        let bool = false;
        for (let i = 0; i < game.length; i++) {
            for (let j = 0; j < Object.keys(game[i]).length; j++) {
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
