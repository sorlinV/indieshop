import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { GenericService } from "./generic.service";
import { UserService } from './user.service';


@Injectable()
export class SessionService {
    protected urlAPI:string = 'http://localhost:3000/user';
    
    constructor(private userService:UserService){}
    
    login (user) {
        localStorage.setItem('user', JSON.stringify(user));
    }

    logout () {
        localStorage.clear();
    }

    getSession() {
        return JSON.parse(localStorage.getItem('user'));
    }
}