import { Component, OnInit } from '@angular/core';
import { UserService } from '../../Services/user.service';


@Component({
  selector: 'app-manageuser',
  templateUrl: './manageuser.component.html',
  styleUrls: ['./manageuser.component.css']
})
export class ManageuserComponent implements OnInit {

  constructor(private user:UserService) {}

  ngOnInit() {
    this.user.getAllUser()
  }

}
