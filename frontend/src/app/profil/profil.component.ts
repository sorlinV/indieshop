import { Component, OnInit } from '@angular/core';
import { User } from '../Classes/User';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.component.html',
  styleUrls: ['./profil.component.css']
})
export class ProfilComponent implements OnInit {
  private is_editing:boolean = false;
  private form;
  constructor(private route:ActivatedRoute) { }

  ngOnInit() {
    this.route.params.subscribe((params) => {
      
      this.form = {
        username: "",
        pass: "",
        pass2: "",
        mail: ""
      }
    });
  }

}
