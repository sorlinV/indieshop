import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { SessionService } from './session.service';
import { Game } from '../Classes/Game';

@Injectable()
export class RateService {
  private urlAPI:string = 'http://localhost:8000/rate';
  constructor(private http:HttpClient) { }

  addRate(token, game, rate):Promise<void> {
    let data = {
        "token": token,
        "game": game,
        "rate": rate
    };
    return this.http.post<void>(this.urlAPI + '/add', data)
    .toPromise();
  }

  removeRate(id, token): Promise<void> {
    let data = {
        "token": token
    }
    return this.http.post<void>(this.urlAPI+'/remove/'+id, data)
    .toPromise();
  }
}
