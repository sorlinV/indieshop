import { Routes } from "@angular/router"
import { AcceuilComponent } from "./acceuil/acceuil.component";
import { NotfoundComponent } from "./notfound/notfound.component";
import { GamesComponent } from "./games/games.component";
import { ProfilComponent } from "./profil/profil.component";
import { ManageuserComponent } from "./admin/manageuser/manageuser.component";
import { ManagegamesComponent } from "./admin/managegames/managegames.component";
import { ManagereportComponent } from "./admin/managereport/managereport.component";
import { AddGameComponent } from "./add-game/add-game.component";
import { InfoGameComponent } from "./info-game/info-game.component";
import { CartComponent } from "./cart/cart.component";

export const appRoutes:Routes = [
    {path: 'addgame', component: AddGameComponent},
    {path: 'managereport', component: ManagereportComponent },
    {path: 'managegames', component: ManagegamesComponent },
    {path: 'manageuser', component: ManageuserComponent},
    {path: 'games', component: GamesComponent},
    {path: 'infogame/:id', component: InfoGameComponent},
    {path: 'profil/:id', component: ProfilComponent},
    {path: 'store', component: AcceuilComponent},
    {path: 'cart', component: CartComponent},
    {path: '', pathMatch: 'full', component: AcceuilComponent},
    {path: '**', component: NotfoundComponent}
]