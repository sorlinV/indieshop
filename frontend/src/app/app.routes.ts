import { Routes } from "@angular/router"
import { AcceuilComponent } from "./acceuil/acceuil.component";
import { NotfoundComponent } from "./notfound/notfound.component";
import { GamesComponent } from "./games/games.component";
import { ProfilComponent } from "./profil/profil.component";
import { ManageuserComponent } from "./admin/manageuser/manageuser.component";
import { ManagegamesComponent } from "./admin/managegames/managegames.component";
import { ManagereportComponent } from "./admin/managereport/managereport.component";

export const appRoutes:Routes = [  
    {path: 'managereport', component: ManagereportComponent },
    {path: 'managegames', component: ManagegamesComponent },
    {path: 'manageuser', component: ManageuserComponent},
    {path: 'games', component: GamesComponent},
    {path: 'profil/:id', component: ProfilComponent},
    {path: 'store', component: AcceuilComponent},
    {path: '', pathMatch: 'full', component: AcceuilComponent},
    {path: '**', component: NotfoundComponent}
]