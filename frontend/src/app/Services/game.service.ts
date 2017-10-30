import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { SessionService } from './session.service';
import { Game } from '../Classes/Game';

@Injectable()
export class GameService {
  private urlAPI:string = 'http://localhost:8000/game';
  constructor(private http:HttpClient) { }

  getAllGame(token):Promise<Game[]> {
    return this.http.post<Game[]>(this.urlAPI + '/all', {token})
    .toPromise();
  }

  addGame(token, name, desc, price):Promise<void> {
    let data = {
        "token": token,
        "name": name,
        "desc": desc,
        "price": price
    };
    return this.http.post<void>(this.urlAPI + '/add', data)
    .toPromise();
  }

  editGame(token, id, name, desc, price): Promise<Game> {
    let data = {
        "token": token,
        "name": name,
        "desc": desc,
        "price": price
    };
    return this.http.post<Game>(this.urlAPI + '/modify/' + id, data)
    .toPromise();
  }

  removeGame(id, token): Promise<void> {
    let data = {
        "token": token
    }
    return this.http.post<void>(this.urlAPI+'/remove/'+id, data)
    .toPromise();
  }

  getGame(id): Promise<void> {
    return this.http.post<void>(this.urlAPI+'/one/'+id, {})
    .toPromise();
  }

}
