import { Component, OnInit } from '@angular/core';
import { User } from '../Classes/User';
import { ActivatedRoute } from '@angular/router';
import { UserService } from '../Services/user.service';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.css']
})
export class ProfilComponent implements OnInit {
  private is_editing:boolean = false;
  private user;
  private form;
  constructor(private route:ActivatedRoute, private userService:UserService) { }

  getUser() {
    this.route.params.subscribe((params) => {
      this.userService.getById(params.id).then((user)=>{
        this.user = user;
        this.form = {
          username: user.username,
          pass: "",
          pass2: "",
          mail: user.mail
        }
      });
    });
  }

  ngOnInit() {
    this.getUser();
  }

  update() {
    this.is_editing = false;
    if (this.form.pass === this.form.pass2 &&
      this.form.pass !== "" &&
      this.form.pass2 !== "") {
        this.route.params.subscribe((params) => {
          this.userService.update(params.id, {
            username: this.form.username,
            password: this.form.pass,
            mail: this.form.mail
          }).then(()=>{this.getUser()});
        });  
      } else {
        this.route.params.subscribe((params) => {
        this.userService.update(params.id, {
          username: this.form.username,
          mail: this.form.mail
        }).then(()=>{this.getUser()});
      });
    }
  }

  remove() {
    this.route.params.subscribe((params) => {
      this.userService.delete(params.id);
    });
  }
}