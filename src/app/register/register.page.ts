import { Component, OnInit, ViewChild } from '@angular/core';
import { ModalController, NavController } from '@ionic/angular';
import { LoginPage } from '../login/login.page';
import { ToastController } from '@ionic/angular';
import { HttpClient, HttpClientModule, HttpHeaders } from '@angular/common/http';
import { FormGroup, Validators, FormControl } from '@angular/forms';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {

  form:FormGroup;

  constructor(
    private modalController: ModalController,
    public toastController: ToastController,
    public http: HttpClient,
  ) { }

  ngOnInit() {
    this.fRegister()
  }

   fRegister() {
     this.form = new FormGroup({
      fName: new FormControl('', Validators.compose([
        Validators.required,
        Validators.pattern('[a-zA-Z ]{2,64}$'),
      ])),
      mName: new FormControl(),
      lName: new FormControl(),
      adrs: new FormControl(),
      pin: new FormControl(),
      city: new FormControl(),
      gender: new FormControl(),
      dob: new FormControl(),
      email: new FormControl(),
      contact: new FormControl(),
      password: new FormControl(),
   });
  }
  
  async loginModal() {
    // this.dismissRegister();
    const loginModal = await this.modalController.create({
      component: LoginPage,
    });
    return await loginModal.present();
  }

  async showToast(message: string){
    const toast = await this.toastController.create({
    message:message, 
    duration: 2000
    }); 
    toast.present(); 
    }

  fetchData() {
    let data = {
        f_name:this.form.value.fName,
        m_name:this.form.value.mName,
        l_name:this.form.value.lName,
        address:this.form.value.adrs,
        pincode:this.form.value.pin,
        city:this.form.value.city,
        dob:this.form.value.dob,
        gender:this.form.value.gender,
        email:this.form.value.email,
        contact_no:this.form.value.contact,
        password:this.form.value.password
    }
    
    this.http.post("http://localhost/Smart-PGApi/registration.php",data).subscribe(res=>{
      console.log(res.status);     
      if(res.status === "success"){
      this.showToast("Inserted successfully"); 
      //this.loginModal();
      }
      else{
      this.showToast("Something went wrong"); 
      }
    })
  }
}