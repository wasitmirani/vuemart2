<template>
  <div>
    <b-form v-on:submit.prevent="onSubmit">
      <b-form-group
        id="input-group-2"
        label="Your Full Name"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="form.name"
          :state="namevalidation"
          @keydown="onchangeerror('name')"
          placeholder="Enter full name"
        ></b-form-input>
        <b-form-invalid-feedback :state="namevalidation">
          Your Name must be 3-50 characters long.
        </b-form-invalid-feedback>
      </b-form-group>

      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          :state="emailvalidation"
          type="email"
          @keydown="onchangeerror('email')"
          placeholder="Enter email"
        ></b-form-input>
        <b-form-invalid-feedback :state="emailvalidation">
          <span v-if="this.errors['email']">
            {{ this.errors["email"][0] }}
          </span>
          <span v-else> Please enter a valid email address </span>
        </b-form-invalid-feedback>
      </b-form-group>
       <b-form-group
        id="input-group-1"
        label="Phone Number:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.phone"
          type="text"
          @keydown="onchangeerror('phone')"
          placeholder="Phone Number"
        ></b-form-input>
        <b-form-invalid-feedback >
          <span v-if="this.errors['phone']">
            {{ this.errors["phone"][0] }}
          </span>

        </b-form-invalid-feedback>
      </b-form-group>

      <b-form-group id="input-group-2" label="Password" label-for="input-2">
        <b-form-input
          id="input-2"
          type="password"
          v-model="form.password"
          :state="passwordvalidation"
          @keydown="onchangeerror('password')"
          placeholder="Enter password"
        ></b-form-input>
        <b-form-invalid-feedback :state="passwordvalidation">
          The password must be at least 8 characters.
        </b-form-invalid-feedback>
      </b-form-group>

      <hr />
      <div class="float-right">
        <b-button type="submit" variant="primary" v-if="!editMode"
          >Save</b-button
        >
        <b-button type="submit" variant="success" v-else>Update</b-button>
        <b-button type="reset" variant="danger" data-dismiss="modal"
          >Close</b-button
        >
        <!-- <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button> -->
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  props: ["editMode", "editForm"],
  computed: {
    emailvalidation() {
      if (this.form.email == "") {
        if (this.errors["email"]) return false;
        else return null;
      } else {
        if (this.errors["email"]) return false;
        else
          return this.form.email == ""
            ? ""
            : this.form.reg.test(this.form.email)
            ? true
            : false;
      }
    },
    namevalidation() {
      if (this.form.name == "") {
        if (this.errors["name"]) return false;
        else return null;
      } else {
        if (this.errors["name"]) return false;
        else return this.form.name.length > 2 && this.form.name.length < 51;
      }
    },
    passwordvalidation() {
      if (this.form.password == "") {
        if (this.errors["password"]) return false;
        else return null;
      } else if (this.errors["password"]) return false;
      else
        return this.form.password.length > 7 && this.form.password.length < 45;
    },
  },
  data() {
    return {
      errors: [],
      editId: "",
      form: {
        name: "",
        password: "",
        email: "",
        reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
        thumbnail: "",
        role: "",
        phone:"",
      },
    };
  },
  methods: {
    onchangeerror(name) {
      // console.log(event);
      this.errors[name] = "";
    },
    rest_form() {
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";
      this.form.phone = "";
    },
    onSubmit() {
      let formdata = new FormData();
      formdata.append("name", this.form.name);
      formdata.append("id", this.editId);
      formdata.append("email", this.form.email);
       formdata.append("phone", this.form.phone);
      formdata.append("password", this.form.password);
      if (!this.editMode) {
        axios
          .post(this.$hostapi_url + "/user/store", formdata, this.$config)
          .then((res) => {
            this.$emit("created", true);

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "New User has been saved",
              showConfirmButton: false,
              timer: 2000,
            });
             this.rest_form();
          })
          .catch((er) => {
            this.errors = er.response.data.errors;

          });
      } else {
        axios
          .post(this.$hostapi_url + "/user/update", formdata, this.$config)
          .then((res) => {
            this.$emit("updated", true);

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User has been updated",
              showConfirmButton: false,
              timer: 2000,
            });
             this.rest_form();

          })
          .catch((er) => {
            this.errors = er.response.data.errors;

          });
      }
    },
  },
  watch: {
    editForm(collection) {
      if (collection == null) {
        return this.rest_form();
      }
      if (collection) {
        this.errors = "";
        this.form.name = collection.name;
        this.form.email = collection.email;
        this.form.phone=collection.phone;
        this.editId = collection.id;
      } else {
        this.rest_form();
      }
    },
  },
  mounted() {

  },
};
</script>

<style>
</style>
