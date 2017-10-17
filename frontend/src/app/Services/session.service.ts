import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { GenericService } from "./generic.service";
import { UserService } from './user.service';


@Injectable()
export class SessionService {
    protected urlAPI:string = 'http://localhost:3000/user';
    
    constructor(private userService:UserService){}
    
    register(username:string, password:string, mail:string) {
        this.userService.getAll().then ((users)=>{
            for (let u of users) {
                if (u.username === username) {
                    return;
                }
            }
            this.userService.add({username: username, password: password, mail: mail})
            .then(()=>{
                this.login(username, password);
            });
        })
    }

    login (username:string, password:string) {
        this.userService.getAll().then ((users)=>{
            for (let u of users) {
                if (u.username === username && u.password === password) {
                    localStorage.setItem('user', JSON.stringify(u));
                }
            }
        })
    }

    getSession() {
        return JSON.parse(localStorage.getItem('user'));
    }
}