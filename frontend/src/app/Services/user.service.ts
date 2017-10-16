import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../Classes/User';

@Injectable()
export class UserService {
  private urlAPI:string = 'http://localhost:3000/User';
  constructor(private http:HttpClient) { }

  getAllUser():Promise<User[]> {
    return this.http.get<User[]>(this.urlAPI)
    .toPromise();
  }

  getUser(id):Promise<User> {
    return this.http.get<User>(this.urlAPI+'/'+id)
    .toPromise();
  }

  addUser(user:User): Promise<User> {
    return this.http.post<User>(this.urlAPI, user)
    .toPromise();
  }

  removeUser(id:number): Promise<void> {
    return this.http.delete<void>(this.urlAPI+'/'+id).toPromise();
  }

}
