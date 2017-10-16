import { Game } from "./Game";
import { Cart } from "./Cart";
import { Rate } from "./Rate";

export interface User {
    username:string;
    password:string;
    salt:string;
    mail:string;
    grade:string;
    creations:Game[];
    games:Game[];
    cart:Cart;
    rates:Rate[];
    token:string;
}