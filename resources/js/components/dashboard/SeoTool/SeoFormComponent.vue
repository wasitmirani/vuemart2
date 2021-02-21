<template>
  <b-form v-on:submit.prevent="onSubmit">
    <div class="form-group row">


          <div class="col-md-12">
        <label for="feedback-user">Page Url</label>
        <b-form-input
          v-model="form.pageurl"
          :state="this.rules.pageurl ? false : validation"
          id="feedback-user"
          @keydown="onChangeError('pageurl')"
          placeholder="Enter Page Url"
          aria-required="true"
          required
        ></b-form-input>
        <b-form-invalid-feedback :state="this.rules.pageurl ? false : validation">
          <span v-if="this.errors['pageurl']">
            {{ this.errors["pageurl"][0] }}
          </span>
          <span v-else> Your  pageurl must be 1-50 characters long. </span>
        </b-form-invalid-feedback>

        <b-form-valid-feedback :state="validation" aria-required="true">
          Looks Good.
        </b-form-valid-feedback>
      </div>
        <div class="col-12">
            <label for="feedback-user">Page Title</label>
                    <input type="text" id="first-pageurl" class="form-control"  placeholder="Page Title"  v-model="form.pagetitle" required/>
        </div>

        <div class="col-12">
            <label for="feedback-user">Meta Description</label>

             <b-form-tags
                input-id="tags-pills"
                v-model="form.metadescription"
                tag-variant="primary"
                tag-pills
                size="md"
                separator=" "
                placeholder="Enter new meta tags by space"
                ></b-form-tags>
        </div>


      <div class="col-md-3 mt-2">
        <b-button type="submit" variant="primary" v-if="!editMode"
          >Submit</b-button
        >
        <b-button type="submit" variant="success" v-else>Update</b-button>
      </div>
    </div>
  </b-form>
</template>

<script>
export default {
  props: ["editMode", "editForm"],
computed: {
    validation() {
      if (this.form.pageurl.length < 1) return null;
      else if (this.rules.pageurl == true) {
        this.rules.pageurl = false;
        return false;
      } else return this.form.pageurl.length > 0 && this.form.pageurl.length < 50;
    },
  },
  data() {
    return {
      errors: [],
      editId: "",
      imgurl: "",
      url: null,
      form: {
        pagetitle: "",
        pageurl: "",
        metadescription:[],
      },

    rules: {
        pageurl: false,
      },
    };
  },
  methods: {

 onChangeError(error) {
      // console.log(event);
      this.errors[error] = "";
    },

    restForm() {
      this.form.pagetitle = "";
      this.form.pageurl = "";
       this.form.metadescription = [];

    },
    async onSubmit(e) {


      if (this.nameValidation()) {
           let fromdata = new FormData();
        fromdata.append("pageurl", this.form.pageurl);
        fromdata.append("pagetitle", this.form.pagetitle);
        fromdata.append("metadescription", this.form.metadescription);

        if (this.editMode) fromdata.append("id", this.editId);
        if (!this.editMode) {
          await axios
            .post(this.$hostapi_url + "/seo", fromdata,this.$config)
            .then((res) => {
              this.$emit("created", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "New  seo page has been created",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch((er) => {
              this.errors = er.response.data.errors;

              if (this.errors["pageurl"] != "") {
                this.rules.pageurl = true;
              }
            });
        } else {
          await axios
            .post(this.$hostapi_url + "/seo/update", fromdata,this.$config)
            .then((res) => {
              this.$emit("updated", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "info",
                title: "Seo Page has been updated",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch((er) => {
              this.errors = er.response.data.errors;

              if (this.errors["pageurl"] != "") {
                this.rules.pageurl = true;
              }
            });
        }
      }
      },
      nameValidation() {
      if (this.form.pageurl.length < 1) {
        this.rules.pageurl = true;
        return false;
      }
      if (this.form.pageurl.length > 0) return true;
    },

  },
  watch: {
    editForm(collection) {
      if (collection == null) {
        return this.restForm();
      }
      if (collection) {
        this.errors = "";
        this.form.pagetitle = collection.page_title;
        this.form.pageurl = collection.page_url;
        this.form.metadescription = collection.meta_description.split(",");

        this.editId = collection.id;
      } else {
        this.restForm();
      }
    },
  },
  mounted() {},
};
</script>

<style>
</style>
