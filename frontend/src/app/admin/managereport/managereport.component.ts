import { Component, OnInit } from '@angular/core';
import { ReportService } from '../../Services/report.service';
import { SessionService } from '../../Services/session.service';

@Component({
  selector: 'app-managereport',
  templateUrl: './managereport.component.html',
  styleUrls: ['./managereport.component.css']
})
export class ManagereportComponent implements OnInit {
  private reports;
  constructor(private reportService:ReportService, private session:SessionService) {}

  ngOnInit() {
    this.reportService.getAllReport(this.session.getSession().token)
    .then((reports)=>{console.log("quelquechose");
    this.reports = reports})
    .catch(err => console.error(err));
  }

}
