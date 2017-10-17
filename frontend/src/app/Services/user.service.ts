import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../Classes/User';
import { GenericService } from './generic.service';


@Injectable()
export class UserService extends GenericService<User> {
    protected urlAPI:string = 'http://localhost:3000/game';
}
// import { Injectable } from '@angular/core';
// import { HttpClient } from '@angular/common/http';
// import { User } from '../Classes/User';

// import 'rxjs/add/operator/toPromise';
// import 'rxjs/add/operator/merge';

// @Injectable()
// export class UserService {
//   private urlAPI:string = 'http://localhost:3000/user';
//   constructor(private http:HttpClient) { }

//   getAllUser():Promise<User[]> {
//     return this.http.get<User[]>(this.urlAPI)
//     .toPromise();
//   }

//   getUser(id):Promise<User> {
//     return this.http.get<User>(this.urlAPI+'/'+id)
//     .toPromise();
//   }
//   addUser(user): Promise<User> {
//     return this.http.post<User>(this.urlAPI, user)
//     .toPromise();
//   }

//   removeUser(id:number): Promise<void> {
//     return this.http.delete<void>(this.urlAPI+'/'+id)
//     .toPromise();
//   }

//   updateUser(id:number, user): Promise<User> {
//     return this.http.patch<User>(this.urlAPI+'/'+id, user)
//     .toPromise();
//   }

// }
