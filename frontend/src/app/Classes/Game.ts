import { User } from "./User";
import { Report } from "./Report";
import { Cart } from "./Cart";
import { Rate } from "./Rate";
import { Tag } from "./Tag";

export interface Game {
    name:string;
    description:string;
    price:number;
    imgs:string[];
    files:string[];
    creators:User[];
    buyer:User[];
    reports:Report[];
    carts:Cart[];
    rates:Rate[];
    tags:Tag[];
}