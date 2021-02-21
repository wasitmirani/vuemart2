<template>
  <div>
    <b-form v-on:submit.prevent="onSubmit">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <label for="feedback-user">Product Name</label>
          <b-form-input
            v-model="form.name"
            :state="this.rules.name ? false : validation"
            id="feedback-user"
            @keydown="onChangeError('name')"
            placeholder="Enter product name"
            aria-required="true"
          ></b-form-input>
          <b-form-invalid-feedback
            :state="this.rules.name ? false : validation"
          >
            <span v-if="this.errors['name']">
              {{ this.errors["name"][0] }}
            </span>
            <span v-else>
              Your product name must be 3-50 characters long.
            </span>
          </b-form-invalid-feedback>

          <b-form-valid-feedback :state="validation" aria-required="true">
            Looks Good.
          </b-form-valid-feedback>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <label for="feedback-user">Quantity PerUnit</label>
          <el-input
            type="text"
            placeholder="Please enter quantity PerUnit"
            v-model="form.quantityPerUnit"
            maxlength="30"
            show-word-limit
          >
          </el-input>
        </div>
        <div class="col-md-2 mt-2">
          <div class="custom-control custom-control-success custom-checkbox">
            <input
              type="checkbox"
              class="custom-control-input"
              id="colorCheck3"
              v-model="form.isfeatured"
              checked
            />
            <label class="custom-control-label" for="colorCheck3"
              >Featured</label
            >
          </div>
        </div>
 <div class="col-md-3 col-sm-6 col-xs-12 mt-2">
          <label for="feedback-user">Units InStock</label>
          <el-input-number
            v-model="form.unitsInStock"
            :precision="2"
            :required="true"
          ></el-input-number>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 mt-2">
          <label for="feedback-user"> Unit Price</label>
          <el-input-number
            v-model="form.unitPrice"
            :precision="2"
            :required="true"
          ></el-input-number>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 mt-2">
          <label for="feedback-user mt-2">Actual UnitPrice</label>
          <el-input-number
            v-model="form.actualPrice"
            :precision="2"
            required
          ></el-input-number>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 mt-2">
          <label for="feedback-user text-center  ">Discount Price</label>
          <el-input-number
            v-model="form.discountPrice"
            :precision="2"
            required
          ></el-input-number>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 mt-2">
          <label for="feedback-user">Description</label>
          <el-input
            type="textarea"
            placeholder="Please enter product description"
            v-model="form.description"
            maxlength="500"
            rows="2"
            show-word-limit
          >
          </el-input>
        </div>
        <div class="col-md-6 col-sm-8 col-xs-12 mt-2">
          <label for="feedback-user">Product Keywords</label>
          <b-form-tags
            input-id="tags-pills"
            v-model="form.keywords"
            tag-variant="success"
            tag-pills
            size="md"
            separator=" "
            placeholder="Enter product keywords"
          ></b-form-tags>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 mt-1">
          <span class="text-danger" v-if="this.fileListError == true">
            <small>
              Your product image upload limit is full 1-6 only upload.</small
            >
          </span>

          <el-upload
            class="upload-demo mt-1"
            drag
            :action="
              this.$hostapi_url +
              '/product/upload/images?name=' +
              this.form.name
            "
            ref="upload"
            :on-success="ImageUploadSuccess"
            :on-remove="handleRemove"
            :limit="6"
            multiple
            :file-list="fileList"
          >
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">
              Drop file here or <em>click to upload Product Images</em>
            </div>
            <div class="el-upload__tip" slot="tip"></div>
          </el-upload>
        </div>
        <div class="col-12">
          <div>
            <div class="row">
              <div v-for="item in this.fileList" :key="item.id">
                <!-- <span>{{ item }}</span> -->

                <b-img
                  :src="baseurl + '/admin/img/products/' + item"
                  width="75"
                  height="75"
                  rounded
                  alt="Rounded image"
                ></b-img>

                <a role="button" @click="deleteImg(item, editId)">
                  <i class="fas fa-trash text-danger"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-12 text-center">
          <span class="text-primary">Product verition's </span>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <label for="feedback-user">Select category with search </label>

          <multiselect
            v-model="form.category"
            :options="this.categories"
            :value="this.form.category"
            placeholder="Select one"
            label="name"

            @input="getSubCategories"
            track-by="id"
          ></multiselect>
 <span class="text-danger" v-show="this.iscategory">The Category field is required</span>
          <!-- <b-form-invalid-feedback >

          </b-form-invalid-feedback> -->
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 mt-2" v-show="subcatshow">

             <multiselect
            v-model="form.subcategory"
            :options="this.subcategories"
            :value="this.form.subcategory"
            placeholder="Select one"
            label="name"

            track-by="id"
          ></multiselect>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-12 text-center">
          <span class="text-primary">Product SEO </span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <label for="feedback-user">Page Title</label>
          <el-input
            type="text"
            placeholder="Please enter page title"
            v-model="form.pageTitle"
            maxlength="30"
            show-word-limit
          >
          </el-input>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <label for="feedback-user"> Meta Description</label>
          <b-form-tags
            input-id="tags-pills"
            v-model="form.metaDescription"
            tag-variant="dark"
            tag-pills
            size="lg"
            separator=" "
            placeholder="Enter new tags"
          ></b-form-tags>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-3 mt-2">
          <b-button type="submit" variant="primary" v-if="!editMode"
            >Submit</b-button
          >
          <b-button type="submit" variant="success" v-else>Update</b-button>
        </div>
      </div>
    </b-form>
  </div>
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
      imageslist: [],
      iscategory:false,
      baseurl: window.location.origin,
      url: null,
      fileList: [],
      fileListError: false,
      subcatshow: false,
      subcategories: [],
      uploadUrl: this.$hostapi_url + "/category/upload",
      form: {
        name: "",
        thumbnail: null,
        subcategory:null,
        category: null,
        unitPrice: 0,
        isfeatured: 0,
        unitsInStock: 10,
        quantityPerUnit: "",
        metaDescription: [],
        description: "",
        pageTitle: "",
        discountPrice: 0,
        actualPrice: 0,
        keywords: [],
      },

      rules: {
        name: false,
      },
    };
  },

  methods: {
    deleteImg(file, id) {
      if (file.length < 1) return this.fileList.pop(file);
      else
        axios
          .get(
            this.$hostapi_url +
              "/product/delete/image?name=" +
              file +
              "&id=" +
              id,
              this.$config
          )
          .then((res) => {
            this.fileList.pop(file);
            if (this.fileList.length < 7) this.fileListError = false;
          });
    },
    handleRemove(file, fileList) {
      axios
        .get(this.$hostapi_url + "/product/delete/image?name=" + file.response,this.$config)
        .then((res) => {
          this.fileList.pop(file.response);
          if (this.fileList.length < 7) this.fileListError = false;
        });
    },
    ImageUploadSuccess(res, file) {
      if (this.fileList.length < 5) this.fileList.push(res);
      else this.fileListError = true;
    },
    getSubCategories() {
      this.subcatshow = false;
      axios.get(this.$hostapi_url + "/product/subcategories/"+this.form.category.id,this.$config).then((res) => {

         this.iscategory=false;
         if(res.data.length>0){
              this.subcatshow = true;
                this.subcategories=res.data;
         }

      });
    },
    RemoveImg() {
      this.url = null;
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
      this.editId = "";

      this.form.category = null;
    this.iscategory=false;
      this.form.unitPrice = 0;
      this.form.unitsInStock = 10;
      this.form.quantityPerUnit = "";
      this.form.metaDescription = [];
      this.form.description = "";
      this.form.pageTitle = "";
      this.form.discountPrice = 0;
      this.form.actualPrice = 0;
      this.form.isfeatured=0;
      this.form.keywords=[];
      this.fileList = [];

      this.subcatshow = false;
      this.form.subcategory=null;
    },
     onSubmit() {
      this.errors = [];
      if (this.nameValidation()) {
        let fromdata = new FormData();
        if(this.form.category!='' & this.form.category==null){
            this.iscategory=true;
            return;
        }
        fromdata.append("name", this.form.name);
        fromdata.append("category_id", this.form.category.id);
        fromdata.append("quantityPerUnit", this.form.quantityPerUnit);
        fromdata.append("subcategory_id", this.form.subcategory);
        fromdata.append("unitPrice", this.form.unitPrice);
        fromdata.append("actualPrice", this.form.actualPrice);
        fromdata.append("unitsInStock", this.form.unitsInStock);
        fromdata.append("discontinued", this.form.discountPrice);
        fromdata.append("description", this.form.description);
        fromdata.append("meta_description", this.form.metaDescription);
        fromdata.append("page_title", this.form.pageTitle);
        fromdata.append("fileList", this.fileList);
        fromdata.append("keywords", this.form.keywords);
        fromdata.append("isfeatured", this.form.isfeatured);

        if (this.editMode)
        fromdata.append("id", this.editId);


        if (!this.editMode) {
           axios
            .post(this.$hostapi_url + "/product", fromdata,this.$config)
            .then((res) => {
              this.$emit("created", true);

              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "New Product has been created",
                showConfirmButton: false,
                timer: 1500,
              });
                this.restForm();
            })
            .catch((er) => {
              this.errors = er.response.data.errors;

              if (this.errors["name"] != "") {
                this.rules.name = true;
              }
            });
        } else {
           axios
            .post(this.$hostapi_url + "/product/update", fromdata,this.$config)
            .then((res) => {
              this.$emit("updated", true);

              Swal.fire({
                position: "top-center",
                icon: "info",
                title: "Product has been updated",
                showConfirmButton: false,
                timer: 1500,
              });
               this.restForm();
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
        this.fileList = [];
        console.log(collection);
        this.errors = "";
        this.form.name = collection.name;
        this.editId = collection.id;
        this.form.isfeatured = collection.isfeatured;
        this.form.quantityPerUnit = collection.quantityPerUnit;
        this.form.category = collection.category;
        if(collection.meta_description.length>0)
        this.form.metaDescription = collection.meta_description.split(",");
        else
         this.form.metaDescription=[];
        if(collection.keywords.length>0)
            this.form.keywords = collection.keywords.split(",");
        else
         this.form.keywords=[];
        this.form.pageTitle = collection.pageTitle;
        this.form.description = collection.description;
        this.form.unitPrice = collection.unitPrice;
        this.form.actualPrice = collection.actualPrice;
        this.form.discountPrice = collection.discount_price;
 this.form.unitsInStock = collection.unitsInStock;
        // this.imageslist=collection.
        for (let index = 0; index < collection.product_images.length; index++) {
          const element = collection.product_images[index].thumbnail;

          this.fileList.push(element);
        }




      } else {
        this.restForm();
      }
    },
  },
  mounted() {},
};
</script>

<style>
@import url("//unpkg.com/element-ui@2.15.0/lib/theme-chalk/index.css");

.el-upload-dragger {
  background-color: #fff;
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  box-sizing: border-box;
  /* width: 360px; */
  height: 180px;
  text-align: center;
  position: relative;
  width: 100%;
  overflow: hidden;
}
</style>
