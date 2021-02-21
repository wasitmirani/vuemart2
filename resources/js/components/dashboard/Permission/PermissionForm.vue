<template>
  <div>
         <b-form v-on:submit.prevent="onSubmit">
                        <b-form-group id="input-group-2" label="Role Name:" label-for="input-2">
                            <b-form-input id="input-2" v-model="form.name"  required :state="namevalidation" @keydown="onchangeerror('name')" placeholder="Enter role name"></b-form-input>
                           <b-form-invalid-feedback :state=" namevalidation">
          <span v-if="this.errors['name']">
            {{ this.errors["name"][0] }}
          </span>
          <span v-else> Your permission name must be 3-50 characters long. </span>
        </b-form-invalid-feedback>
                        </b-form-group>

                        <b-form-group id="input-group-1" label="Roles" label-for="input-1">

                                  <multiselect v-model="selectedroles"
                                  placeholder="Search Roles" label="name" track-by="id" :options="roles"
                                  :multiple="true"  :taggable="true" ><span slot="noResult">Oops! No elements found. Consider changing the search query.</span></multiselect>
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
props: ["editMode", "editForm","roles"],
 computed: {
        namevalidation() {
            if (this.form.name == "") {
                if (this.errors["name"]) return false;
                else return null;
            } else {
                if (this.errors["name"]) return false;
                else
                    return (
                        this.form.name.length > 2 && this.form.name.length < 51
                    );
            }
        },
        },
    data(){
        return {
             selectedroles: [],
                errors:[],
                form:{
                    name:"",
                },
        }
    },
methods:{
    onchangeerror(name) {
      // console.log(event);
      if( this.errors[name]!=null & this.errors[name]!="" ){
          this.errors[name] = "";
      }

    },
    rest_form() {
      this.form.name = "";
      this.selectedroles =[];
    },
    onSubmit() {
      let formdata = new FormData();
      formdata.append("name", this.form.name);
      formdata.append("id", this.editId);
      let roles=[];
      for (let index = 0; index <  this.selectedroles.length; index++) {
          const element = this.selectedroles[index].id;
        roles.push(element);
      }
      formdata.append("roles",roles);

      if (!this.editMode) {
        axios
          .post(this.$hostapi_url + "/permission/store", formdata, this.$config)
          .then((res) => {
            this.$emit("created", true);
            this.rest_form();
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "New permission has been saved",
              showConfirmButton: false,
              timer: 2000,
            });
          })
          .catch((er) => {
            this.errors = er.response.data.errors;
            console.log(this.errors);
          });
      } else {
        axios
          .post(this.$hostapi_url + "/permission/update", formdata, this.$config)
          .then((res) => {
            this.$emit("updated", true);
            this.rest_form();
            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Permission has been updated",
              showConfirmButton: false,
              timer: 2000,
            });
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
        this.selectedroles = collection.roles;
        this.editId = collection.id;
      } else {
        this.rest_form();
      }
    },
  },
  mounted() {

  },
}
</script>

<style>

</style>
