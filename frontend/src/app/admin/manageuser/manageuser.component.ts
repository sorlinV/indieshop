import { Component, OnInit } from '@angular/core';
import { UserService } from '../../Services/user.service';


@Component({
  selector: 'app-manageuser',
  templateUrl: './manageuser.component.html',
  styleUrls: ['./manageuser.component.css']
})
export class ManageuserComponent implements OnInit {
  private users;
  constructor(private user:UserService) {}

  ngOnInit() {
    this.user.getAllUser().then((users)=>{this.users = users}).catch(err => console.log(err));
  }

}
