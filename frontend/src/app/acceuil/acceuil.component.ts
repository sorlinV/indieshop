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

  public rate(game_id, rate){
    this.rateService.addRate(this.session.getSession().token, game_id, rate)
    .then(($message)=>{
      this.ngOnInit();
    }).catch(error => console.error(error));
  }

  public unRate(rate_id){
    this.rateService.removeRate(rate_id, this.session.getSession().token)
    .then(($message)=>{
      this.game.getAllGame().then((games)=>{
        this.games = games;
      }).catch(error => console.error(error));;
    }).catch(error => console.error(error));
  }

  public editRate(rate_id, game_id, rate){
    this.rateService.removeRate(rate_id, this.session.getSession().token)
    .then(($message)=>{
      this.rateService.addRate(this.session.getSession().token, game_id, rate)
      .then(($message)=>{
        this.ngOnInit();
      }).catch(error => console.error(error));;
    }).catch(error => console.error(error));
  }

  getRate(game, username) {
    for (let rate of game.rates) {
      if (rate.user.username === username) {
        return rate;
      }
    }
    return false;
  }

  moyRate(game) {
    if (game === undefined || game.rates.length === 0) {
      return 0;
    }
    let total = 0;
    for (let rate of game.rates) {
      total += rate.rate;
    }
    return total / game.rates.length;
  }
}
