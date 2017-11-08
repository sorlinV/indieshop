import { Component, OnInit } from '@angular/core';
import { GameService } from '../Services/game.service';
import { SessionService } from '../Services/session.service';
import { RateService } from '../Services/rate.service';
import { Observable } from 'rxjs/Observable';

@Component({
  selector: 'app-acceuil',
  templateUrl: './acceuil.component.html',
  styleUrls: ['./acceuil.component.css']
})
export class AcceuilComponent implements OnInit {
  private games;
  constructor(private game:GameService, public session:SessionService,
    private rateService:RateService) { }

  ngOnInit() {
    this.game.getAllGame().then((games)=>{
      this.games = games;
    }).catch(error => console.error(error));
  }

  reload() {
    this.ngOnInit();
  }
}
