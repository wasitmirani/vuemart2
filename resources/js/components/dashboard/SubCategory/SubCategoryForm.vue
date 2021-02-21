<template>
  <b-form v-on:submit.prevent="onSubmit">
    <div class="form-group row">
      <div class="col-md-12">
        <label for="feedback-user"> Name</label>
        <b-form-input
          v-model="form.name"
          :state="this.rules.name ? false : validation"
          id="feedback-user"
          @keydown="onChangeError('name')"
          placeholder="Enter  name"
          aria-required="true"
        ></b-form-input>
        <b-form-invalid-feedback :state="this.rules.name ? false : validation">
          <span v-if="this.errors['name']">
            {{ this.errors["name"][0] }}
          </span>
          <span v-else> Your name must be 3-50 characters long. </span>
        </b-form-invalid-feedback>

        <b-form-valid-feedback :state="validation" aria-required="true">
          Looks Good.
        </b-form-valid-feedback>
      </div>
      <div class="col-md-12 mt-1">
        <label for="feedback-user">Select category with search </label>

        <multiselect
          v-model="form.category"
          :options="this.categories"
          :value="this.form.category"
          placeholder="Select one"
          label="name"
          :allow-empty="false"
          track-by="id"
        ></multiselect>

        <b-form-invalid-feedback>
          <span>The Category field is required</span>
        </b-form-invalid-feedback>
      </div>
      <div class="col-md-12 mt-2" v-if="this.editMode && !url">
        <div id="preview">
          <b-img
            thumbnail
            fluid
            :src="editthumbnailurl"
            style="height: 200px; width: 70%"
            v-if="(imgurl != null) & (imgurl != '')"
          ></b-img>
        </div>
      </div>
      <div class="col-md-12 mt-2" v-if="url && this.editMode">
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
      <div class="col-md-4 mt-2">
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
      </div>
      <div class="col-md-2 float-right mt-4">
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
  props: ["editMode", "editForm", "categories"],
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
      editthumbnailurl: null,
      url: null,

      form: {
        name: "",
        thumbnail: null,
        isFeatured: 1,
        category: "",
      },

      rules: {
        name: false,
        category: false,
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
      this.form.category = null;
      this.imgurl = "";
      this.RemoveImg();
    },
    async onSubmit(e) {
      this.errors = [];
      if (this.nameValidation()) {
        let fromdata = new FormData();
        if (this.form.category.length < 1) {
          this.rules.category = true;
          return;
        } else {
          this.rules.category = false;
        }
        fromdata.append("name", this.form.name);
        fromdata.append("isFeatured", this.form.isFeatured);
        fromdata.append("cateogry_id", this.form.category.id);
        if (this.editMode) fromdata.append("id", this.editId);
        if ((this.form.thumbnail != null) & (this.form.thumbnail != ""))
          fromdata.append("thumbnail", this.form.thumbnail);

        if (!this.editMode) {
          await axios
            .post(this.$hostapi_url + "/subcategory", fromdata,this.$config)
            .then((res) => {
              this.$emit("created", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "New Sub Category has been created",
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
            .post(this.$hostapi_url + "/subcategory/update", fromdata,this.$config)
            .then((res) => {
              this.$emit("updated", true);
              this.restForm();
              Swal.fire({
                position: "top-center",
                icon: "info",
                title: "Sub Category has been updated",
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
        this.RemoveImg();
        this.form.name = collection.name;
        this.imgurl = collection.thumbnail;
        this.form.isFeatured = collection.status;
        this.editthumbnailurl = collection.thumbnailurl;
        this.form.category = collection.category;
        this.editId = collection.id;
      } else {
        this.restForm();
      }
    },
  },
  mounted() {
    console.log(this.categories);
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
