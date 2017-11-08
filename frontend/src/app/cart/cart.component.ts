import { Component, OnInit } from '@angular/core';
import { SessionService } from '../Services/session.service';
import { CartService } from '../Services/cart.service';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {
  private games;
  constructor(private session:SessionService, private cartService:CartService) { }

  ngOnInit() {
    this.cartService.getCart(this.session.getSession().token).then((games)=>{
      this.games = games;
    });
  }

  getTotal() {
    let total = 0;
    for(let game of this.games)
    {
      total += game.price;
    }
  }
}
