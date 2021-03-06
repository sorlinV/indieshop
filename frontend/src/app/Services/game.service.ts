import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { SessionService } from './session.service';
import { Game } from '../Classes/Game';
import { Mess } from '../Classes/Mess';

@Injectable()
export class GameService {
  private urlAPI:string = 'http://localhost:8000/game';
  constructor(private http:HttpClient) { }

  getAllGame():Promise<Game[]> {
    return this.http.post<Game[]>(this.urlAPI + '/all', {})
    .toPromise();
  }

  addGame(token, name, desc, price, tags):Promise<Mess> {
    let data = {
        "token": token,
        "name": name,
        "desc": desc,
        "price": price,
        "tags": tags
    };
    return this.http.post<Mess>(this.urlAPI + '/add', data)
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

  removeGame(id, token): Promise<Mess> {
    let data = {
        "token": token
    }
    return this.http.post<Mess>(this.urlAPI+'/remove/'+id, data)
    .toPromise();
  }

  getGame(id): Promise<Mess> {
    return this.http.post<Mess>(this.urlAPI+'/one/'+id, {})
    .toPromise();
  }

}
