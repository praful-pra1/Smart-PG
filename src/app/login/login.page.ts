import { Component, OnInit } from '@angular/core';
import { ModalController, NavController, ToastController } from '@ionic/angular';
import { RegisterPage } from '../register/register.page';
import { HomePage } from '../home/home.page';
import { FormGroup, Validators, FormControl } from '@angular/forms';
import { from } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  form:FormGroup;

  constructor(
    private modalController: ModalController,
    private navCtrl: NavController,
    public toastController: ToastController,
    public http: HttpClient,
  ) { }

  ngOnInit() {

    this.flogin();
  }

  flogin(){
    this.form = new FormGroup({

      email: new FormControl(),
      password: new FormControl(),
    });

  }

  // dismissLogin() {
  //   this.modalController.dismiss();
  // }

  async home(){

    const homeModal = await this.modalController.create({
      component: HomePage,
    });
    return await homeModal.present();
  }

  async registerModal() {
    // this.dismissLogin();
    const registerModal = await this.modalController.create({
      component: RegisterPage
    });
    return await registerModal.present();
  }

  async forgotPass(){

  }

  login(){

    let data = {
      
      email:this.form.value.email,
      password:this.form.value.password
    }

    this.http.get("http://localhost/Smart-PGApi/login_controller.php").subscribe(res => {
        console.log(res.status);
      },
      err => {
        console.log(err.status);
      }
    );

    //this.home();
  }
}
