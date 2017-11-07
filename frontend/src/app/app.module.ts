import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {FormsModule} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';

import { AppComponent } from './app.component';
import { AcceuilComponent } from './acceuil/acceuil.component';
import { SearchComponent } from './acceuil/search/search.component';
import { GamesComponent } from './games/games.component';
import { ProfilComponent } from './profil/profil.component';
import { RouterModule } from '@angular/router';
import { appRoutes } from './app.routes';
import { NotfoundComponent } from './notfound/notfound.component';
import { HeaderComponent } from './header/header.component';
import { UserService } from './Services/user.service';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { SessionService } from './Services/session.service';
import { AdminComponent } from './admin/admin.component';
import { ManageuserComponent } from './admin/manageuser/manageuser.component';
import { ManagegamesComponent } from './admin/managegames/managegames.component';
import { ManagereportComponent } from './admin/managereport/managereport.component';
import { RateService } from './Services/rate.service';
import { GameService } from './Services/game.service';
import { CartService } from './Services/cart.service';
import { ReportService } from './Services/report.service';
import { AddGameComponent } from './add-game/add-game.component';
import { InfoGameComponent } from './info-game/info-game.component';

@NgModule({
  declarations: [
    AppComponent,
    AcceuilComponent,
    SearchComponent,
    GamesComponent,
    ProfilComponent,
    NotfoundComponent,
    HeaderComponent,
    LoginComponent,
    RegisterComponent,
    AdminComponent,
    ManageuserComponent,
    ManagegamesComponent,
    ManagereportComponent,
    AddGameComponent,
    InfoGameComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [
    UserService,
    SessionService,
    CartService,
    GameService,
    RateService,
    ReportService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
