<template>
  <div>
 <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="App Setting"
      :breadcrumbbar="true"
    ></Breadcrumb>
   <div class="content-body"><!-- users edit start -->
<section class="app-user-edit">
  <div class="card">
    <div class="card-body">
      <ul class="nav nav-pills" role="tablist">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><span class="d-none d-sm-block">Account</span>
          </a>
        </li>
        <li class="nav-item" v-can="'AppInfoUpdate'">
          <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg><span class="d-none d-sm-block">Information</span>
          </a>
        </li>
        <li class="nav-item"  v-can="'AppSocialUpdate'">
          <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg><span class="d-none d-sm-block">Social</span>
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <!-- Account Tab starts -->
        <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
          <!-- users edit media object start -->

          <!-- users edit media object ends -->
          <!-- users edit account form start -->

        <b-form v-on:submit.prevent="onSubmit" class="form-validate" novalidate="novalidate">
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" placeholder="Name" v-model="user.name"   name="name" aria-invalid="false" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" class="form-control" placeholder="Email" v-model="user.email" value="" name="email" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Mobile</label>
                  <input type="email" class="form-control" placeholder="Mobile" v-model="user.mobile" value="" name="mobile" required>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="company">Company</label>
                  <input type="text" class="form-control" value="Vuemart.pk" placeholder="Company name" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="company">Current Password</label>
                  <input type="password" class="form-control"   @keydown="onchangeerror('oldpassword')" v-model="user.oldpassword" placeholder="Current Password" >
                </div>
                <span class="text-danger"> {{ this.errors["oldpassword"] }}</span>
                 <b-form-invalid-feedback >

          <span v-if="this.errors['oldpassword']">
            {{ this.errors["oldpassword"] }}
          </span>

        </b-form-invalid-feedback>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="company">New Password</label>
                  <input type="password" class="form-control"  v-model="user.password" placeholder="New Password" >
                </div>
              </div>
               <div class="col-md-4">
                    <div class="form-group">
                         <label for="email">User Thumbnail</label>
                    <el-upload
                        :action="this.$hostapi_url+'/user/thumbnail/update?name='+this.auth_user.name+'&id='+this.auth_user.id"
                        list-type="picture-card"
                        :on-preview="handlePictureCardPreview"
                        :on-remove="handleRemove">
                        <i class="el-icon-plus"></i>
                        </el-upload>
                        <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                 </el-dialog>
                    </div>

                </div>

              <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>

              </div>
            </div>
        </b-form>

          <!-- users edit account form ends -->
        </div>
        <!-- Account Tab ends -->

        <!-- Information Tab starts -->
        <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel"  v-can="'AppInfoUpdate'">
          <!-- users edit Info form start -->
        <b-form v-on:submit.prevent="websiteInfoUpdate" class="form-validate" novalidate="novalidate">
            <div class="row mt-1">
              <div class="col-12">
                <h4 class="mb-1">
                 <i class="fa fa-globe" aria-hidden="true"></i>
                  <span class="align-middle">Website Information</span>
                </h4>
              </div>

              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="mobile">Contact</label>
                  <input type="text" class="form-control" placeholder="Contact Number" v-model="contact" required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="website">E-mail</label>
                     <input  type="email" class="form-control" placeholder="E-Mail Address"   v-model="email" required>
                </div>
              </div>


         <div class="col-lg-4 col-md-6">
                  <div class="form-group">
                  <label for="website">Working Days/Hours</label>
                     <input  type="tagcontent" class="form-control"  placeholder="Mon - Sun / 9:00AM - 9:00PM" name="phone" v-model="timing" required>
                  </div>
              </div>
              <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                  <label for="website">Tag Content</label>
                     <input  type="tagcontent" class="form-control"  name="phone" placeholder="content...." v-model="tagcontent" required>
                  </div>
              </div>
              <div class="col-12">
                <h4 class="mb-1 mt-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin font-medium-4 mr-25"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  <span class="align-middle">Address</span>
                </h4>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="address-1">Address Line 1</label>
                  <input type="text" class="form-control"  v-model="address1" name="address"  placeholder="Adress"    required>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="address-2">Address Line 2</label>
                  <input  type="text" class="form-control" v-model="address2" placeholder="Adress" >
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="postcode">Postcode</label>
                  <input  type="number" class="form-control" v-model="zipcode" placeholder="zip code">
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" v-model="city" placeholder="City">
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <input  type="text" class="form-control" name="state" v-model="state" placeholder="State">
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input v-model="country" type="text" class="form-control" name="country" placeholder="Country">
                </div>
              </div>
              <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>

              </div>
            </div>
        </b-form>
          <!-- users edit Info form ends -->
        </div>
        <!-- Information Tab ends -->

        <!-- Social Tab starts -->
        <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel" v-can="'AppSocialUpdate'">
          <!-- users edit social form start -->
           <b-form v-on:submit.prevent="websiteSocialUpdate" class="form-validate" novalidate="novalidate">
            <div class="row">
              <div class="col-lg-4 col-md-6 form-group">
                <label for="twitter-input">Twitter</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter font-medium-2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </span>
                  </div>
                  <input id="twitter-input" type="text" class="form-control" v-model="twitter"  placeholder="Twitter account url" aria-describedby="basic-addon3">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 form-group">
                <label for="facebook-input">Facebook</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook font-medium-2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </span>
                  </div>
                  <input id="facebook-input" type="text" class="form-control" v-model="facebook" laceholder="https://www.facebook.com/"  placeholder="Facebook account url"  aria-describedby="basic-addon4">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 form-group">
                <label for="instagram-input">Instagram</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon5">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram font-medium-2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </span>
                  </div>
                  <input id="instagram-input" type="text" class="form-control" v-model="instagram"  placeholder="Instagram account url" aria-describedby="basic-addon5">
                </div>
              </div>


              <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light">Save Changes</button>

              </div>
            </div>
           </b-form>
          <!-- users edit social form ends -->
        </div>
        <!-- Social Tab ends -->
      </div>
    </div>
  </div>
</section>
<!-- users edit ends -->

   </div>
  </div>

</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";

export default {
  components: {
    Breadcrumb,

  },
  data(){
      return{
        dialogImageUrl: '',
        dialogVisible: false,
        auth_user:{},
        errors:[],
        websiteinfo:{},
        user:{
            name:"",
            email:"",
            mobile:"",
            password:"",
            oldpassword:"",
        },
        contact:"",
        email:"",
        timing:"",
        tagcontent:"",
        address1:"",
        address2:"",
        zipcode:"",
        city:"",
        state:"",
        country:"",
        twitter:"",
        facebook:"",
        instagram:"",


      };
  },

  methods: {
      websiteSocialUpdate(){
        let formdata = new FormData();
        formdata.append("twitter",this.twitter);
        formdata.append("facebook",this.facebook);
        formdata.append("instagram",this.instagram);
           axios.post(this.$hostapi_url + "/website/social/update",formdata, this.$config).then((res)=>{
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "website social has been updated",
              showConfirmButton: false,
              timer: 2000,
            });
        });
      },
      websiteInfoUpdate(){
        let formdata = new FormData();
        formdata.append("contact",this.contact);
        formdata.append("email",this.email);
        formdata.append("tagcontent",this.tagcontent);
        formdata.append("timing",this.timing);
        formdata.append("address1",this.address1);
        formdata.append("address2",this.address2);
        formdata.append("zipcode",this.zipcode);
        formdata.append("city",this.city);
        formdata.append("state",this.state);
        formdata.append("country",this.country);
        axios.post(this.$hostapi_url + "/website/info/update",formdata, this.$config).then((res)=>{
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "website Content has been updated",
              showConfirmButton: false,
              timer: 2000,
            });
        });
      },
      getwebsiteInfo(){
          axios.get(this.$hostapi_url + "/website/info", this.$config).then((res)=>{
              this.websiteinfo=res.data;
              this.contact=this.websiteinfo.contact;
              this.email=this.websiteinfo.email;
              this.tagcontent=this.websiteinfo.tagcontent;
              this.timing=this.websiteinfo.timing;
              this.address1=this.websiteinfo.address1;
              this.address2=this.websiteinfo.address2;
              this.zipcode=this.websiteinfo.zipcode;
              this.city=this.websiteinfo.city;
              this.state=this.websiteinfo.state;
              this.country=this.websiteinfo.country;
              this.twitter=this.websiteinfo.twitter;
              this.facebook=this.websiteinfo.facebook;
              this.instagram=this.websiteinfo.instagram;
          });
      },
      onchangeerror(name){
          this.errors[name]="";
      },
        onSubmit(){
     let formdata = new FormData();
      formdata.append("name", this.user.name);
      formdata.append("id", this.auth_user.id);
      formdata.append("email", this.user.email);
            formdata.append("phone", this.user.mobile);
      formdata.append("password", this.user.password);
      formdata.append("oldpassword", this.user.oldpassword);

        axios
          .post(this.$hostapi_url + "/update/user/account", formdata, this.$config)
          .then((res) => {

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Account has been updated",
              showConfirmButton: false,
              timer: 2000,
            });
          })
          .catch((er) => {

            this.errors = er.response.data;

          });
        },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePictureCardPreview(file) {
        this.dialogImageUrl = file.url;
        this.dialogVisible = true;
      }
    },
    mounted(){
         this.auth_user = this.$attrs["authuser"];
         this.user.name=this.auth_user.name;
         this.user.email=this.auth_user.email;
         this.user.mobile=this.auth_user.phone;
         this.getwebsiteInfo();
    }
}
</script>

<style>
</style>
