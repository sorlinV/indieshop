import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { Cart } from '../Classes/Cart';
import { Game } from '../Classes/Game';

@Injectable()
@Injectable()
export class CartService {
  private urlAPI:string = 'http://localhost:8000/cart';
  constructor(private http:HttpClient) { }

  addCart(token, game):Promise<void> {
    let data = {
        "token": token,
        "game": game
    };
    return this.http.post<void>(this.urlAPI + '/add', data)
    .toPromise();
  }

  getCart(token):Promise<Game[]> {
    let data = {
        "token": token
    };
    return this.http.post<Game[]>(this.urlAPI + '/games', data)
    .toPromise();
  }

  removeCart(token, game): Promise<void> {
    let data = {
        "token": token,
        "game": game
    };
    return this.http.post<void>(this.urlAPI+'/del', data)
    .toPromise();
  }

  buyCart(token, game): Promise<void> {
    let data = {
      "token": token
    };
    return this.http.post<void>(this.urlAPI+'/buy', data)
      .toPromise();
  }

}
