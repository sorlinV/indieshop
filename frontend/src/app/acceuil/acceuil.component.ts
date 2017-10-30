import { Component, OnInit } from '@angular/core';
import { GameService } from '../Services/game.service';
import { SessionService } from '../Services/session.service';
import { RateService } from '../Services/rate.service';

@Component({
  selector: 'app-acceuil',
  templateUrl: './acceuil.component.html',
  styleUrls: ['./acceuil.component.css']
})
export class AcceuilComponent implements OnInit {
  private games;
  constructor(private game:GameService, private session:SessionService,
    private rateService:RateService) { }

  ngOnInit() {
    this.game.getAllGame().then((games)=>{
      this.games = games;
    });
  }

  public log(a){
    console.log(a);
  }

  public rate(game_id, rate){
    this.rateService.addRate(this.session.getSession().token, game_id, rate).then((json)=>(this.log(json)));
  }
}
