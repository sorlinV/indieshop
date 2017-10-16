import { User } from "./User";
import { Report } from "./Report";
import { Cart } from "./Cart";
import { Rate } from "./Rate";
import { Tag } from "./Tag";

export class Game {
    private name:string;
    private description:string;
    private price:number;
    private imgs:string[];
    private files:string[];
    private creators:User[];
    private buyer:User[];
    private reports:Report[];
    private carts:Cart[];
    private rates:Rate[];
    private tags:Tag[];
}