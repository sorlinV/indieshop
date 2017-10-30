import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../Classes/User';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { SessionService } from './session.service';

@Injectable()
export class UserService {
  private urlAPI:string = 'http://localhost:8000/user';
  constructor(private http:HttpClient) { }

  getAllUser():Promise<User[]> {
    return this.http.post<User[]>(this.urlAPI, {})
    .toPromise();
  }

  loginUser(usermail, password):Promise<User> {
    let data = {
        "usermail": usermail,
        "password": password
    }
    return this.http.post<User>(this.urlAPI + '/login', data)
    .toPromise();
  }

  registerUser(username, mail, password): Promise<User> {
    let data = {
        "username": username,
        "mail": mail,
        "password": password
    }
    return this.http.post<User>(this.urlAPI + '/register', data)
    .toPromise();
  }

  editUser(token, id, username, mail, password): Promise<User> {
    let data = {
        "token": token,
        "username": username,
        "mail": mail,
        "password": password
    }
    return this.http.post<User>(this.urlAPI + '/modify/' + id, data)
    .toPromise();
  }

  removeUser(id, token): Promise<void> {
    let data = {
        "token": token
    }
    return this.http.post<void>(this.urlAPI+'/remove/'+id, data)
    .toPromise();
  }

  getUser(id): Promise<void> {
    return this.http.post<void>(this.urlAPI+'/remove/'+id, {})
    .toPromise();
  }

}
