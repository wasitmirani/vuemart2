<template>
  <b-form v-on:submit.prevent="onSubmit">
    <div class="form-group row">
      <div class="col-md-12">
        <label for="feedback-user">Slider Heading</label>
        <b-form-input
          v-model="form.name"
          :state="this.rules.name ? false : validation"
          id="feedback-user"
          @keydown="onChangeError('heading')"
          placeholder="Enter heading "
          aria-required="true"
          required
        ></b-form-input>
        <b-form-invalid-feedback :state="this.rules.name ? false : validation">
          <span v-if="this.errors['heading']">
            {{ this.errors["heading"][0] }}
          </span>
          <span v-else> Your heading must be 3-50 characters long. </span>
        </b-form-invalid-feedback>

        <b-form-valid-feedback :state="validation" aria-required="true">
          Looks Good.
        </b-form-valid-feedback>
      </div>

      <div class="col-md-12 mt-2">
          <el-input
            type="textarea"
            placeholder="Enter Subheading"
            v-model="form.subheading"
            maxlength="100"
            show-word-limit
            :aria-required="true"
            >
            </el-input>
      </div>
       <div class="col-md-12 mt-2">
        <b-form-input
          id="input-1"
          v-model="form.link"
          type="text"
          placeholder="Enter Link"
          required
        ></b-form-input>
       </div>
         <div class="col-md-12 mt-2">
        <b-form-input
          id="input-1"
          v-model="form.position"
          type="number"
          placeholder="Enter Position"
          required
        ></b-form-input>
       </div>

      <div class="col-md-12 mt-2" v-if="url">
        <div id="preview">
          <b-img
            thumbnail
            fluid
            :src="url"
            style="height: 200px; width: 70%"
          ></b-img>
          <a role="button" @click="RemoveImg">
            <i class="fas fa-trash text-danger"></i>
          </a>
        </div>
      </div>
      <div class="col-md-8 mt-1">
        <b-form-file
          v-model="form.thumbnail"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
          @change="onFileChange"
        ></b-form-file>
      </div>
      <!-- <div class="col-md-4 mt-2">
        <div class="custom-control custom-control-success custom-checkbox">
          <input
            type="checkbox"
            class="custom-control-input"
            id="colorCheck3"
            v-model="form.isFeatured"
            checked
          />
          <label class="custom-control-label" for="colorCheck3">Active</label>
        </div>
      </div> -->

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
      if (this.form.name.length < 1) return null;
      else if (this.rules.name == true) {
        this.rules.name = false;
        return false;
      } else return this.form.name.length > 2 && this.form.name.length < 50;
    },
  },
  data() {
    return {
      errors: [],
      editId: "",
      imgurl: "",
      url: null,
      uploadUrl: this.$hostapi_url + "/slider/upload",
      form: {
        name: "",
        thumbnail: null,
        subheading:"",
        link:"",
        position:"",
        isFeatured: 1,
      },

      rules: {
        name: false,
      },
    };
  },
  methods: {
    RemoveImg() {
      this.url = null;
      this.form.thumbnail = null;
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    onChangeError(error) {
      // console.log(event);
      this.errors[error] = "";
    },
    restForm() {
      this.form.name = "";
      this.form.thumbnail = null;
        this.form.subheading="";
        this.form.link="";
        this.form.position="";
        this.url=null;
    },
    async onSubmit(e) {
      this.errors = [];
      if (this.nameValidation()) {
        let fromdata = new FormData();
        fromdata.append("name", this.form.name);
        fromdata.append("subheading", this.form.subheading);
         fromdata.append("link", this.form.link);
        fromdata.append("sort", this.form.position);




        fromdata.append("isFeatured", this.form.isFeatured);
        if (this.editMode) fromdata.append("id", this.editId);
        if ((this.form.thumbnail != null) & (this.form.thumbnail != ""))
          fromdata.append("thumbnail", this.form.thumbnail);

        if (!this.editMode) {
          await axios
            .post(this.$hostapi_url + "/slider/store", fromdata, this.$config)
            .then((res) => {
              this.$emit("created", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "New Slider has been created",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch((er) => {
              this.errors = er.response.data.errors;

              if (this.errors["name"] != "") {
                this.rules.name = true;
              }
            });
        } else {
          await axios
            .post(this.$hostapi_url + "/slider/update", fromdata, this.$config)
            .then((res) => {
              this.$emit("updated", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "info",
                title: "Slider has been updated",
                showConfirmButton: false,
                timer: 1500,
              });
            })
            .catch((er) => {
              this.errors = er.response.data.errors;

              if (this.errors["name"] != "") {
                this.rules.name = true;
              }
            });
        }
      }
    },

    nameValidation() {
      if (this.form.name.length < 1) {
        this.rules.name = true;
        return false;
      }
      if (this.form.name.length > 2) return true;
    },
  },
  watch: {
    editForm(collection) {
      if (collection == null) {
        return this.restForm();
      }
      if (collection) {
        this.errors = "";
        this.form.name = collection.heading;
        this.imgurl = collection.thumbnail;
        // this.form.isFeatured = collection.status;
        this.form.subheading=collection.subheading;
        this.form.link=collection.link;
        this.form.position=collection.sort;
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
