<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      backName="Categories"
      backUrl="/categories"
      activeName="SubCategories"
      :breadcrumbbar="true"
    ></Breadcrumb>
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="card card-statistics">
          <div class="card-header">
            <h4 class="card-title">Sub Categories Statistics</h4>
            <div class="d-flex align-items-center">
              <p class="card-text mr-25 mb-0">Over view</p>
            </div>
          </div>
          <div class="card-body statistics-body">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                <div class="media">
                  <div class="avatar bg-light-primary mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Total Sub Categories"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.total }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Total</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                <div class="media">
                  <div class="avatar bg-light-success mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Active Sub Categories"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.active }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Active</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                <div class="media">
                  <div class="avatar bg-light-danger mr-2">
                    <div
                      class="avatar-content"
                      v-b-tooltip.hover
                      title="Disable Sub Categories"
                    >
                      <i class="fab fa-buffer avatar-icon"></i>
                    </div>
                  </div>
                  <div class="media-body my-auto">
                    <h4 class="font-weight-bolder mb-0">
                      {{ this.staticList.disable }}
                    </h4>
                    <p class="card-text font-small-3 mb-0">Disable</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-12">
                <router-link to="/trashed/SubCategories">
                  <div class="media">
                    <div class="avatar bg-light-warning mr-2">
                      <div
                        class="avatar-content"
                        v-b-tooltip.hover
                        title="Trashed Sub Categories"
                      >
                        <i class="fab fa-buffer avatar-icon"></i>
                      </div>
                    </div>
                    <div class="media-body my-auto">
                      <h4 class="font-weight-bolder mb-0">
                        {{ this.staticList.trashed }}
                      </h4>
                      <p class="card-text font-small-3 mb-0">Trashed</p>
                    </div>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--/ Miscellaneous Charts -->
    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Sub Categories List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'subcategory?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getSubCategories()"
                    v-on:dataList="searchData($event)"
                    label="Search Sub Categories"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4">
                <button
                  type="button"
                  value=""
                  class=".btn-sm btn-primary form-control"
                  @click="openPopup"
                  style="height: auto"
                >
                  New Sub Category
                </button>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md">
            <SubCategoryList
              :subCategories="this.subCategories"
              :query="query"
              :getSubCategories="getSubCategories"
              v-on:editData="editData($event)"
              v-on:deleteData="deleteData($event)"
            ></SubCategoryList>
          </b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
    <!-- Modal -->
    <div
      class="modal fade text-left"
      id="modal_id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel17"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="!editMode">
              Create New Sub Category
            </h4>
            <h4 class="modal-title" v-else>Update Sub Category</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <SubCategoryForm
              :editMode="editMode"
              :editForm="editCollection"
              :categories="this.categories"
              v-on:created="closePopup($event)"
              v-on:updated="closePopup($event)"
            ></SubCategoryForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";
import SearchInput from "../Search/SearchFilterComponent";
import SubCategoryForm from "./SubCategoryForm";
import SubCategoryList from "./SubCategoryListComponent";

export default {
  components: {
    Breadcrumb,
    SearchInput,
    SubCategoryForm,
    SubCategoryList,
  },
  data() {
    return {
      staticList: {
        active: 0,
        total: 0,
        disable: 0,
        trashed: 0,
      },
      isLoading: false,
      subCategories: {},
      categories: [],
      pageNum: 1,
      query: "",
      editMode: false,
      editCollection: {},
    };
  },
  methods: {
    isLoadingStart(value) {
      this.isLoading = value;
    },
    openPopup() {
      this.editMode = false;
      this.editCollection = null;
      $("#modal_id").modal("show");
    },
    closePopup(item) {
      if (item) {
        this.getSubCategories();
        $("#modal_id").modal("hide");
      }
    },
    isquery(query) {
      return (this.query = query);
    },
    editData(item) {
      this.editMode = true;
      this.editCollection = item;
      $("#modal_id").modal("show");
    },
    searchData(data) {
      this.subCategories = data.subCategories;
    },
    getSubCategories(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url +
            "/subcategory?page=" +
            page +
            "&query=" +
            this.query,
          this.$config
        )
        .then((res) => {
          this.subCategories = res.data.subCategories;
          this.staticList.active = res.data.active;
          this.staticList.total = res.data.total;
          this.staticList.disable = res.data.disable;
          this.staticList.trashed = res.data.trashed;
          this.categories = res.data.categories;

          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },

    deleteData(item) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(this.$hostapi_url + "/subcategory/" + item.id, this.$config)
            .then((res) => {
              this.getSubCategories();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
  mounted() {
    this.getSubCategories();
  },
};
</script>

<style>
</style>
