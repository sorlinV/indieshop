import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/merge';
import { SessionService } from './session.service';
import { Report } from '../Classes/Report';

@Injectable()
export class ReportService {
  private urlAPI:string = 'http://localhost:8000/user';
  constructor(private http:HttpClient) { }

  getAllReport(token):Promise<Report[]> {
    return this.http.post<Report[]>(this.urlAPI, {token})
    .toPromise();
  }

  addReport(token, game):Promise<void> {
    let data = {
        "token": token,
        "game": game
    };
    return this.http.post<void>(this.urlAPI + '/add', data)
    .toPromise();
  }

  removeReport(id, token): Promise<void> {
    let data = {
        "token": token
    }
    return this.http.post<void>(this.urlAPI+'/remove/'+id, data)
    .toPromise();
  }
}
