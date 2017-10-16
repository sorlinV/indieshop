import { Game } from "./Game";
import { Cart } from "./Cart";
import { Rate } from "./Rate";

export class User {
    private username:string;
    private password:string;
    private salt:string;
    private mail:string;
    private grade:string;
    private creations:Game[];
    private games:Game[];
    private cart:Cart;
    private rates:Rate[];
    private token:string;
}