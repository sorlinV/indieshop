import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  private loginHidden = true;
  private registerHidden = true;
  constructor(private session:SessionService) { }

  ngOnInit() {
    console.log(this.session.getSession());
  }

}
