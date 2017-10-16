import { User } from "./User";
import { Game } from "./Game";

export interface Rate {
    note:number;
    date:string;
    user:User;
    game:Game;
}